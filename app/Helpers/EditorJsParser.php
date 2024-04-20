<?php

declare(strict_types=1);

namespace App\Helpers;

use DOMDocument;
use DOMText;
use Exception;
use Masterminds\HTML5;
use stdClass;

class EditorJsParser
{
    /**
     * @var stdClass
     */
    private $data; // @pest-ignore-type

    /**
     * @var DOMDocument
     */
    private $dom; // @pest-ignore-type

    /**
     * @var HTML5
     */
    private $html5; // @pest-ignore-type

    /**
     * @var string
     */
    private $prefix = 'prs'; // @pest-ignore-type

    public function __construct(string $data)
    {
        $this->data = json_decode($data);

        $this->dom = new DOMDocument('1.0', 'UTF-8');

        $this->html5 = new HTML5([
            'target_document' => $this->dom,
            'disable_html_ns' => true,
        ]);
    }

    public static function parse($data)// @pest-ignore-type
    {
        return new self($data);
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    public function getTime()// @pest-ignore-type
    {
        return isset($this->data->time) ? $this->data->time : null;
    }

    public function getVersion()// @pest-ignore-type
    {
        return isset($this->data->version) ? $this->data->version : null;
    }

    public function getBlocks()// @pest-ignore-type
    {
        return isset($this->data->blocks) ? $this->data->blocks : null;
    }

    public function toHtml()// @pest-ignore-type
    {
        $this->init();

        return $this->dom->saveHTML();
    }

    /**
     * @throws Exception
     */
    private function init()// @pest-ignore-type
    {
        if (!$this->hasBlocks()) {
            throw new Exception('No Blocks to parse !');
        }
        foreach ($this->data->blocks as $block) {
            switch ($block->type) {
                case 'header':
                    $this->parseHeader($block);
                    break;
                case 'delimiter':
                    $this->parseDelimiter();
                    break;
                case 'code':
                    $this->parseCode($block);
                    break;
                case 'paragraph':
                    $this->parseParagraph($block);
                    break;
                case 'link':
                    $this->parseLink($block);
                    break;
                case 'embed':
                    $this->parseEmbed($block);
                    break;
                case 'raw':
                    $this->parseRaw($block);
                    break;
                case 'list':
                    $this->parseList($block);
                    break;
                case 'warning':
                    $this->parseWarning($block);
                    break;
                case 'simpleImage':
                    $this->parseImage($block);
                    break;
                case 'image':
                    $this->parseNormalImage($block);
                    break;
                case 'quote':
                    $this->parseQuote($block);
                    break;
                default:
                    break;
            }
        }
    }

    private function hasBlocks()// @pest-ignore-type
    {
        return \count($this->data->blocks) !== 0;
    }

    private function parseHeader($block)// @pest-ignore-type
    {
        $text = new DOMText($block->data->text);

        $header = $this->dom->createElement('h'.$block->data->level);

        $header->setAttribute('class', "{$this->prefix}-h{$block->data->level}");

        $header->appendChild($text);

        $this->dom->appendChild($header);
    }

    private function parseDelimiter()// @pest-ignore-type
    {
        $node = $this->dom->createElement('hr');

        $node->setAttribute('class', "{$this->prefix}-delimiter");

        $this->dom->appendChild($node);
    }

    private function parseCode($block)// @pest-ignore-type
    {
        $wrapper = $this->dom->createElement('div');

        $wrapper->setAttribute('class', "{$this->prefix}-code");

        $pre = $this->dom->createElement('pre');

        $code = $this->dom->createElement('code');

        $content = new DOMText($block->data->code);

        $code->appendChild($content);

        $pre->appendChild($code);

        $wrapper->appendChild($pre);

        $this->dom->appendChild($wrapper);
    }

    private function parseParagraph($block)// @pest-ignore-type
    {
        $node = $this->dom->createElement('p');

        $node->setAttribute('class', "{$this->prefix}-paragraph");

        $node->appendChild($this->html5->loadHTMLFragment($block->data->text));

        $this->dom->appendChild($node);
    }

    private function parseLink($block)// @pest-ignore-type
    {
        $link = $this->dom->createElement('a');

        $link->setAttribute('href', $block->data->link);
        $link->setAttribute('target', '_blank');
        $link->setAttribute('class', "{$this->prefix}-link");

        $innerContainer = $this->dom->createElement('div');
        $innerContainer->setAttribute('class', "{$this->prefix}-link-container");

        $hasTitle = isset($block->data->meta->title);
        $hasDescription = isset($block->data->meta->description);
        $hasImage = isset($block->data->meta->image);

        if ($hasTitle) {
            $titleNode = $this->dom->createElement('div');
            $titleNode->setAttribute('class', "{$this->prefix}-link-title");
            $titleText = new DOMText($block->data->meta->title);
            $titleNode->appendChild($titleText);
            $innerContainer->appendChild($titleNode);
        }

        if ($hasDescription) {
            $descriptionNode = $this->dom->createElement('div');
            $descriptionNode->setAttribute('class', "{$this->prefix}-link-description");
            $descriptionText = new DOMText($block->data->meta->description);
            $descriptionNode->appendChild($descriptionText);
            $innerContainer->appendChild($descriptionNode);
        }

        $linkContainer = $this->dom->createElement('div');
        $linkContainer->setAttribute('class', "{$this->prefix}-link-url");
        $linkText = new DOMText($block->data->link);
        $linkContainer->appendChild($linkText);
        $innerContainer->appendChild($linkContainer);

        $link->appendChild($innerContainer);

        if ($hasImage) {
            $imageContainer = $this->dom->createElement('div');
            $imageContainer->setAttribute('class', "{$this->prefix}-link-img-container");
            $image = $this->dom->createElement('img');
            $image->setAttribute('src', $block->data->meta->image->url);
            $imageContainer->appendChild($image);
            $link->appendChild($imageContainer);
            $innerContainer->setAttribute('class', "{$this->prefix}-link-container-with-img");
        }

        $this->dom->appendChild($link);
    }

    private function parseEmbed($block)// @pest-ignore-type
    {
        $wrapper = $this->dom->createElement('div');

        $wrapper->setAttribute('class', "{$this->prefix}-embed");

        switch ($block->data->service) {
            case 'youtube':

                $attrs = [
                    'height' => $block->data->height,
                    'src' => $block->data->embed,
                    'allow' => 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture',
                    'allowfullscreen' => true,
                ];

                $wrapper->appendChild($this->createIframe($attrs));

                break;
            case 'codepen' || 'gfycat':

                $attrs = [
                    'height' => $block->data->height,
                    'src' => $block->data->embed,
                ];

                $wrapper->appendChild($this->createIframe($attrs));

                break;
        }

        $this->dom->appendChild($wrapper);
    }

    private function createIframe(array $attrs)// @pest-ignore-type
    {
        $iframe = $this->dom->createElement('iframe');

        foreach ($attrs as $key => $attr) {
            $iframe->setAttribute($key, $attr);
        }

        return $iframe;
    }

    private function parseRaw($block)// @pest-ignore-type
    {
        $wrapper = $this->dom->createElement('div');

        $wrapper->setAttribute('class', "{$this->prefix}-raw");

        $wrapper->appendChild($this->html5->loadHTMLFragment($block->data->html));

        $this->dom->appendChild($wrapper);
    }

    private function parseList($block)// @pest-ignore-type
    {
        $wrapper = $this->dom->createElement('div');
        $wrapper->setAttribute('class', "{$this->prefix}-list");

        $list = null;

        switch ($block->data->style) {
            case 'ordered':
                $list = $this->dom->createElement('ol');
                break;
            default:
                $list = $this->dom->createElement('ul');
                break;
        }

        foreach ($block->data->items as $item) {
            $li = $this->dom->createElement('li');
            $li->appendChild($this->html5->loadHTMLFragment($item));
            $list->appendChild($li);
        }

        $wrapper->appendChild($list);

        $this->dom->appendChild($wrapper);
    }

    private function parseWarning($block)// @pest-ignore-type
    {
        $title = new DOMText($block->data->title);
        $message = new DOMText($block->data->message);

        $wrapper = $this->dom->createElement('div');
        $wrapper->setAttribute('class', "{$this->prefix}-warning");

        $textWrapper = $this->dom->createElement('div');
        $titleWrapper = $this->dom->createElement('p');

        $titleWrapper->appendChild($title);
        $messageWrapper = $this->dom->createElement('p');

        $messageWrapper->appendChild($message);

        $textWrapper->appendChild($titleWrapper);
        $textWrapper->appendChild($messageWrapper);

        $icon = $this->dom->createElement('ion-icon');
        $icon->setAttribute('name', 'information-outline');
        $icon->setAttribute('size', 'large');

        $wrapper->appendChild($icon);
        $wrapper->appendChild($textWrapper);

        $this->dom->appendChild($wrapper);
    }

    private function parseImage($block)// @pest-ignore-type
    {
        $figure = $this->dom->createElement('figure');

        $figure->setAttribute('class', "{$this->prefix}-image");

        $img = $this->dom->createElement('img');

        $imgAttrs = [];

        if ($block->data->withBorder) {
            $imgAttrs[] = "{$this->prefix}-image-border";
        }
        if ($block->data->withBackground) {
            $imgAttrs[] = "{$this->prefix}-image-background";
        }
        if ($block->data->stretched) {
            $imgAttrs[] = "{$this->prefix}-image-stretched";
        }

        $img->setAttribute('src', $block->data->url);
        $img->setAttribute('class', implode(' ', $imgAttrs));

        $figCaption = $this->dom->createElement('figcaption');

        $figCaption->appendChild($this->html5->loadHTMLFragment($block->data->caption));

        $figure->appendChild($img);

        $figure->appendChild($figCaption);

        $this->dom->appendChild($figure);
    }

    private function parseNormalImage($block)// @pest-ignore-type
    {
        $figure = $this->dom->createElement('figure');

        $figure->setAttribute('class', "{$this->prefix}-image");

        $img = $this->dom->createElement('img');

        $imgAttrs = [];

        if ($block->data->withBorder) {
            $imgAttrs[] = "{$this->prefix}-image-border";
        }
        if ($block->data->withBackground) {
            $imgAttrs[] = "{$this->prefix}-image-background";
        }
        if ($block->data->stretched) {
            $imgAttrs[] = "{$this->prefix}-image-stretched";
        }

        $img->setAttribute('src', $block->data->file->url);
        $img->setAttribute('class', implode(' ', $imgAttrs));

        $figCaption = $this->dom->createElement('figcaption');

        $figCaption->appendChild($this->html5->loadHTMLFragment($block->data->caption));

        $figure->appendChild($img);

        $figure->appendChild($figCaption);

        $this->dom->appendChild($figure);
    }

    private function parseQuote($block)// @pest-ignore-type
    {
        $blockQuote = $this->dom->createElement('blockquote');
        $p = $this->dom->createElement('p');
        $footer = $this->dom->createElement('footer');

        $p->appendChild($this->html5->loadHTMLFragment($block->data->text));
        $footer->appendChild($this->html5->loadHTMLFragment($block->data->caption));

        $blockQuote->appendChild($p);
        $blockQuote->appendChild($footer);

        $this->dom->appendChild($blockQuote);
    }
}
