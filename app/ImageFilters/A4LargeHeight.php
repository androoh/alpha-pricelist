<?php

namespace App\ImageFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class A4LargeHeight implements FilterInterface
{
    const MAX_HEIGHT = 2480;

    public function applyFilter(Image $image)
    {
        return $image->heighten(self::MAX_HEIGHT, function ($constraint) {
            $constraint->upsize();
        });
    }

}
