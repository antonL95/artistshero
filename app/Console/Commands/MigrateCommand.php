<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Helpers\EditorJsParser;
use App\Models\Artist;
use App\Models\Filter;
use App\Models\Post;
use App\Models\Product;
use Awcodes\Curator\Models\Media;
use Illuminate\Console\Command;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MigrateCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:migrate-command';

    /**
     * @var string
     */
    protected $description = 'Migration script for data from old system';

    public function handle(): void
    {
        $url = 'https://admin.artistshero.com/api';
        $key = '17ee504c2646b95435186b0855fb9535d23bedb0cb9cc5d99cd8349b43acc1fb165771bcb5b1a769517e3ddf334ec1a9566a787a2fa089dc5c2103789b18d1f0aafee5a35ba0b7b9d53ab9a052268b9643a3f0545cfbbcb27727d864e85b350e2a8a8ee5ba507ed2aa42be050ff5eba54c3a76ec6cd4e9aa1990b5a05915ee67';

        $client = Http::withHeader(
            'Authorization',
            'Bearer '.$key,
        );

        $fetchedArtists = (array) $client->get(
            $url.'/artists',
            ['populate' => '*', 'lang' => app()->getLocale(), 'pagination' => ['pageSize' => 1000, 'page' => 1]],
        )->json('data');
        $fetchedFilters = (array) $client->get(
            $url.'/filters',
            ['populate' => '*', 'lang' => app()->getLocale(), 'pagination' => ['pageSize' => 1000, 'page' => 1]],
        )->json('data');
        $fetchedProducts = (array) $client->get(
            $url.'/products',
            ['populate' => '*', 'lang' => app()->getLocale(), 'pagination' => ['pageSize' => 1000, 'page' => 1]],
        )->json('data');
        $fetchedPosts = (array) $client->get(
            $url.'/posts',
            ['populate' => '*', 'lang' => app()->getLocale(), 'pagination' => ['pageSize' => 1000, 'page' => 1]],
        )->json('data');

        $this->handleArtists($fetchedArtists);
        $this->handleFilters($fetchedFilters);
        $this->handleProducts($fetchedProducts);
        $this->handlePosts($fetchedPosts);
    }

    private function handleArtists(array $fetchedArtists): void
    {
        $parsedArtists = [];
        foreach ($fetchedArtists as $data) {
            $attr = $data['attributes'];
            $name = $attr['name'];
            $bio = new EditorJsParser($attr['bio']);

            $profileI = $this->parseImagesFromData($attr['profileImage']['data']);
            $coverI = $this->parseImagesFromData($attr['coverImage']['data']);

            $otherImages = [];
            if (isset($attr['otherImages']['data'])) {
                foreach ($attr['otherImages']['data'] as $item) {
                    $otherImages[] = $this->parseImagesFromData($item);
                }
            }

            $parsedArtists[] = [
                'name' => $name,
                'bio' => $bio->toHtml(),
                'profileI' => $profileI,
                'coverI' => $coverI,
                'otherImages' => $otherImages,
            ];
        }

        foreach ($parsedArtists as $parsedArtist) {
            $name = $parsedArtist['name'].uniqid('', true);
            try {
                $profileImageId = $this->handleImageUpload($parsedArtist['profileI'], $name);
                $coverImageId = $this->handleImageUpload($parsedArtist['coverI'], $name);
            } catch (\ErrorException) {
                continue;
            }

            $artist = Artist::create([
                'name' => ['cs' => $parsedArtist['name']],
                'bio' => ['cs' => $parsedArtist['bio']],
                'created_by' => 1,
                'profile_image_id' => $profileImageId,
                'cover_image_id' => $coverImageId,
            ]);

            if (!empty($parsedArtist['otherImages'])) {
                foreach ($parsedArtist['otherImages'] as $otherImage) {
                    try {
                        $otherImageId = $this->handleImageUpload($otherImage, $parsedArtist['name'].uniqid('', true));
                    } catch (\ErrorException) {
                        continue;
                    }

                    DB::insert(
                        'INSERT INTO `artist_images` (`artist_id`, `media_id`) VALUES (? , ?)',
                        [$artist->id, $otherImageId],
                    );
                }
            }
        }
    }

    private function handleFilters(array $fetchedFilters): void
    {
        foreach ($fetchedFilters as $filter) {
            Filter::create([
                'type' => ['cs' => $filter['attributes']['type']],
                'name' => ['cs' => $filter['attributes']['value']],
                'created_by' => 1,
            ]);
        }
    }

    private function handleProducts(array $fetchedProducts): void
    {
        $parsedProducts = [];

        foreach ($fetchedProducts as $product) {
            $attr = $product['attributes'];
            $name = $attr['name'];
            $description = new EditorJsParser($attr['description']);

            $images = [];
            if (isset($attr['images']['data'])) {
                foreach ($attr['images']['data'] as $item) {
                    $images[] = $this->parseImagesFromData($item);
                }
            }

            if (!isset($attr['artist']['data'])) {
                continue;
            }

            $artistName = $attr['artist']['data']['attributes']['name'];

            $filters = [];

            if (isset($attr['filters']['data']) && \count($attr['filters']['data']) > 0) {
                foreach ($attr['filters']['data'] as $item) {
                    $filters[] = [
                        'type' => $item['attributes']['type'],
                        'name' => $item['attributes']['value'],
                    ];
                }
            }

            $parsedProducts[] = [
                'name' => $name,
                'description' => $description->toHtml(),
                'images' => $images,
                'artistName' => $artistName,
                'filters' => $filters,
            ];
        }

        foreach ($parsedProducts as $parsedProduct) {
            $artist = Artist::where('name->cs', $parsedProduct['artistName'])->firstOrFail();

            $product = Product::create([
                'name' => ['cs' => $parsedProduct['name']],
                'description' => ['cs' => $parsedProduct['description']],
                'created_by' => 1,
                'artist_id' => $artist->id,
            ]);

            foreach ($parsedProduct['images'] as $image) {
                try {
                    $productImageId = $this->handleImageUpload($image, $parsedProduct['name'].uniqid('', true));
                } catch (\ErrorException) {
                    continue;
                }

                DB::insert(
                    'INSERT INTO `product_images` (`product_id`, `media_id`) VALUES (? , ?)',
                    [$product->id, $productImageId],
                );
            }

            foreach ($parsedProduct['filters'] as $filter) {
                $filterFromDb = Filter::where('name->cs', $filter['name'])->where('type->cs', $filter['type'])->first();

                if ($filterFromDb === null) {
                    continue;
                }

                DB::insert(
                    'INSERT INTO `product_filter` (`filter_id`, `product_id`) VALUES (? , ?)',
                    [$filterFromDb->id, $product->id],
                );
            }
        }
    }

    private function handlePosts(array $fetchedPosts): void
    {
        $parsedPosts = [];
        foreach ($fetchedPosts as $post) {
            $attr = $post['attributes'];
            $title = $attr['title'];
            $subtitle = $attr['subtitle'];
            $content = new EditorJsParser($attr['content']);
            $coverImage = $this->parseImagesFromData($attr['coverImage']['data']);
            $thumbnail = $this->parseImagesFromData($attr['thumbnail']['data']);

            $images = [];
            if (isset($attr['images']['data'])) {
                foreach ($attr['images']['data'] as $item) {
                    $images[] = $this->parseImagesFromData($item);
                }
            }

            $parsedPosts[] = [
                'title' => $title,
                'subtitle' => $subtitle,
                'content' => $content->toHtml(),
                'coverImage' => $coverImage,
                'thumbnail' => $thumbnail,
                'images' => $images,
            ];
        }

        foreach ($parsedPosts as $parsedPost) {

            try {
                $coverImageId = $this->handleImageUpload($parsedPost['coverImage'], $parsedPost['title'].uniqid('', true));
            } catch (\ErrorException) {
                continue;
            }

            try {
                $thumbnailId = $this->handleImageUpload($parsedPost['thumbnail'], $parsedPost['title'].uniqid('', true));
            } catch (\ErrorException) {
                continue;
            }
            $post = Post::create([
                'title' => ['cs' => $parsedPost['title']],
                'subtitle' => ['cs' => $parsedPost['subtitle']],
                'content' => ['cs' => $parsedPost['content']],
                'cover_image_id' => $coverImageId,
                'thumbnail_image_id' => $thumbnailId,
                'created_by' => 1,
            ]);

            foreach ($parsedPost['images'] as $image) {
                try {
                    $postImageId = $this->handleImageUpload($image, $parsedPost['title'].uniqid('', true));
                } catch (\ErrorException) {
                    continue;
                }
                DB::insert('INSERT INTO `post_images` (`post_id`, `media_id`) VALUES (? , ?)', [$post->id, $postImageId]);
            }
        }
    }

    private function parseImagesFromData(array $preparsedItem): array
    {
        if (isset($preparsedItem['attributes']['formats']['large'])) {
            $item = $preparsedItem['attributes']['formats']['large'];
        } elseif (isset($preparsedItem['attributes']['formats']['medium'])) {
            $item = $preparsedItem['attributes']['formats']['medium'];
        } else {
            $item = $preparsedItem['attributes'];
        }

        return [
            'width' => $item['width'],
            'height' => $item['height'],
            'size' => (int) $item['size'] * 1024,
            'type' => $item['mime'],
            'ext' => $item['ext'],
            'contents' => $item['url'],
        ];
    }

    private function handleImageUpload(
        array $params,
        string $name,
    ): int {
        $contents = file_get_contents($params['contents']);
        $file = '/tmp/'.$name;
        file_put_contents($file, $contents);
        $uploaded_file = new UploadedFile($file, $name);

        $path = Storage::putFile('/media', $uploaded_file);

        unlink($file);

        $media = Media::create([
            'disk' => 'r2',
            'directory' => 'media',
            'visibility' => 'public',
            'name' => $name,
            'path' => $path,
            'width' => $params['width'],
            'height' => $params['height'],
            'size' => $params['size'],
            'type' => $params['type'],
            'ext' => Str::replace('.', '', $params['ext']),
            'title' => $name,
        ]);

        return $media->id;
    }

    private function parseTextBlocks(array $blocks): string
    {
        $string = '';

        foreach ($blocks as $item) {
            if (!isset($item['data']['text'])) {
                continue;
            }

            $string .= '<p>'.$item['data']['text'].'</p>';
        }

        return $string;
    }
}
