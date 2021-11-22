<?php

namespace App\ImageFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Svg implements FilterInterface
{

    public function applyFilter(Image $image)
    {
        return $image;
    }

}
