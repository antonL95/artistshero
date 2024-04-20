<?php

declare(strict_types=1);

use App\Models\Artist;
use App\Models\Product;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', static function (BreadcrumbTrail $trail) {
    $trail->push(trans('gallery.productDetail.breadcrumb.home'), route('gallery'));
});

Breadcrumbs::for('product.detail', static function (BreadcrumbTrail $trail, Product $product) {
    $trail->parent('home');
    $trail->push($product->artist->name, route('artist.detail', $product->artist->id));
    $trail->push($product->name, route('product.detail', ['id' => $product->id]));
});

Breadcrumbs::for('artist.detail', static function (BreadcrumbTrail $trail, Artist $artist) {
    $trail->parent('home');
    $trail->push($artist->name, route('artist.detail', ['id' => $artist->id]));
});
