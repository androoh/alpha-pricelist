<?php

namespace App\ImageFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class A4MediumHeight implements FilterInterface
{
    const MAX_HEIGHT = 1240;

    public function applyFilter(Image $image)
    {
        return $image->heighten(self::MAX_HEIGHT, function ($constraint) {
            $constraint->upsize();
        });
    }

}
