<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceRequest;
use App\Models\Product;

class Prices extends Controller
{
    const PRICE_LIST_RESOURCE_NAME = 'priceList';

    public function index(ResourceRequest $request, $priceListId)
    {
        $resource = $request->getResource(self::PRICE_LIST_RESOURCE_NAME);
        $model = $resource::model();
        $priceList = $model::find($priceListId);
        $mainProducts = data_get($priceList, 'mainProductsPage.main_products', []);
        $result = [];
        $prices = data_get($priceList, 'prices', []);
        foreach ($mainProducts as $mainProduct) {
            $product = Product::find(data_get($mainProduct, 'id', null));
            if ($product->child_product_ids) {
                $childProducts = Product::find($product->child_product_ids);
                foreach ($childProducts as $childProduct) {
                    if (!isset($result[$childProduct->getkey()])) {
                        $result[$childProduct->getkey()] = [
                            'id' => $childProduct->getkey(),
                            'name' => $childProduct->name,
                            'sku' => $childProduct->sku,
                            'type' => $childProduct->type,
                            'price' => data_get($prices, $childProduct->getkey(), 0)
                        ];
                    }
                }
            }
        }
        return response([
            'defaultLocale' => config('app.locale'),
            'data' => array_values($result)
        ]);
    }

    public function store(ResourceRequest $request, $priceListId)
    {
        $resource = $request->getResource(self::PRICE_LIST_RESOURCE_NAME);
        $model = $resource::model();
        $priceList = $model::find($priceListId);
        $prices = $request->input('prices', null);
        if ($prices) {
            $priceList->prices = $prices;
            $priceList->save();
        }
        response(['ok']);
    }
}
