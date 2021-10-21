<?php


namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    const PRODUCT_TYPE_MAIN = 'product_main';
    const PRODUCT_TYPE_MODEL = 'product_model';
    const PRODUCT_TYPE_OPTION = 'product_option';

    const PRODUCT_PRICE_TYPE_PER_UNIT = 'per_unit';
    const PRODUCT_PRICE_TYPE_PER_SQM = 'per_sqm';
    const PRODUCT_PRICE_TYPE_LM = 'per_lm';

    protected $guarded = [];

    public function mainProducts()
    {
        return $this->belongsToMany(
            Product::class, null, 'parent_product_ids', 'child_product_ids'
        );
    }

    public function productOptions()
    {
        return $this->hasMany(Product::class);
    }

    public function productModels()
    {
        return $this->hasMany(Product::class);
    }
}
