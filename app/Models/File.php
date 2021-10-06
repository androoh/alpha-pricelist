<?php


namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class File extends Model
{
    protected $dates = ['createdAt'];
    protected $guarded = [];
}
