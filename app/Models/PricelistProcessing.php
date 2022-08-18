<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class PricelistProcessing extends Model
{
    const PRICELIST_TO_PDF_KEY = 'pricelist-to-pdf';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';
    const STATUS_PROGRESS = 'progress';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'resourceKey',
        'status'
    ];

    protected $guarded = [];
}
