<?php

declare(strict_types=1);

use App\Livewire\ArtistDetail;
use App\Livewire\BlogPost;
use App\Livewire\Gallery;
use App\Livewire\ProductDetail;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome', [
    'mediaCards' => [
        [
            'name' => 'Firma může pomocí umění komunikovat své hodnoty',
            'image' => 'img/media_1.webp',
            'link' => 'https://www.kancelare.cz/firma-muze-pomoci-umeni-komunikovat-sve-hodnoty-rika-zakladatel-artist-s-hero-marek-jakubek',
        ],
        [
            'name' => 'Netroufáte si umělecké dílo do kanceláře koupit? Pronajměte si jej',
            'image' => 'img/media_2.webp',
            'link' => 'https://www.kancelare.cz/marek-jakubek-netroufate-si-umelecke-dilo-do-kancelare-koupit-pronajmete-si-jej',
        ],
        [
            'name' => 'Umění rozšiřuje obzory a umožňuje nám obklopit se umělcovou energií',
            'image' => 'img/media_3.webp',
            'link' => 'https://www.kancelare.cz/umeni-rozsiruje-obzory-a-umoznuje-nam-obklopit-se-umelcovou-energii-rika-zakladatel-artist-s-hero-marek-jakubek',
        ],
        [
            'name' => 'Umění v kanceláři. Příklady z CAPEXu dokazují, že se vyplatí ho mít',
            'image' => 'img/media_4.webp',
            'link' => 'https://www.capexus.cz/blog/umeni-v-kancelari-priklady-z-capexu-dokazuji-ze-se-vyplati-ho-mit',
        ],
        [
            'name' => 'Átrium projektu Kesselbauer oživí originálne umelecké dielo',
            'image' => 'img/media_5.webp',
            'link' => 'https://www.kesselbauer.sk/sk/novinky/atrium-projektu-kesselbauer-ozivi-originalne-umelecke-dielo',
        ],
        [
            'name' => 'Vernisáž: Enjoy ART WORKS',
            'image' => 'img/media_6.webp',
            'link' => '"https://www.capexus.cz/vernisaz-enjoy-art-works',
        ],
        [
            'name' => 'Umění nás inspiruje dívat se znovu a jinak: Podcast',
            'image' => 'img/media_7.webp',
            'link' => 'https://open.spotify.com/episode/3JHFnGkyjvKK9IZmWxuXOZ?si=nPrGmX77Qdakazg14hQNow&nd=1',
        ],
    ],
])->name('home');

Route::get('/gallery', Gallery::class)->name('gallery');

Route::get('/gallery/product/{id}', ProductDetail::class)->name('product.detail');

Route::get('/gallery/artist/{id}', ArtistDetail::class)->name('artist.detail');

Route::get('/blog/{id}', BlogPost::class)->name('blog.post');
