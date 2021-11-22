<?php

namespace App\ImageFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class A4LargeWidth implements FilterInterface
{
    const MAX_WIDTH = 3508;

    public function applyFilter(Image $image)
    {
        return $image->widen(self::MAX_WIDTH, function ($constraint) {
            $constraint->upsize();
        });
    }

}
