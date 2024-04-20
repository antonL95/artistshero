<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductFilter extends Pivot
{
    public $incrementing = true;
}
