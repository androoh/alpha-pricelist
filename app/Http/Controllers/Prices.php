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
        foreach(data_get($priceList, 'mainProductsPage.categories') as $treeItem) {
            foreach (data_get($treeItem, 'main_products', []) as $product) {
                if ($productId = data_get($product, 'id', false)) {
                    if ($product = \App\Models\Product::find($productId)) {
                        if ($product->child_product_ids) {
                            $childProducts = Product::find($product->child_product_ids);
                            foreach ($childProducts as $childProduct) {
                                if (!isset($result[$product->getKey() . '#' . $childProduct->getkey()])) {
                                    $result[$product->getKey() . '#' . $childProduct->getkey()] = [
                                        'id' => $product->getKey() . '#' . $childProduct->getkey(),
                                        'name' =>  $childProduct->name,
                                        'parent' => $product->name,
                                        'sku' => $childProduct->sku,
                                        'type' => $childProduct->type,
                                        'price' => data_get($prices, $product->getKey() . '#' . $childProduct->getkey(), 0)
                                    ];
                                }
                            }
                        }
                    }
                }
            }
        }
        $productSections = data_get($priceList, 'optionsAndAccessoriesPage.product_options_sections', false);
        foreach ($productSections as $productSection) {
            foreach(data_get($productSection, 'product_option_sections', []) as $productOptionSection) {
                foreach(data_get($productOptionSection, 'product_options', []) as $productOption) {
                    $productOptionId = data_get($productOption, 'id', false);
                    if ($productOptionId) {
                        $productOptionData = \App\Models\Product::find($productOptionId);
                        $result[$productOptionData->getkey()] = [
                            'id' => $productOptionData->getkey(),
                            'name' =>  $productOptionData->name,
                            'parent' => data_get($productSection, 'title', ''),
                            'sku' => $productOptionData->sku,
                            'type' => $productOptionData->type,
                            'price' => data_get($prices, $productOptionData->getkey(), 0)
                        ];
                    }
                }
            }
        }
        // foreach ($mainProducts as $mainProduct) {
        //     $product = Product::find(data_get($mainProduct, 'id', null));
        //     if ($product->child_product_ids) {
        //         $childProducts = Product::find($product->child_product_ids);
        //         foreach ($childProducts as $childProduct) {
        //             if (!isset($result[$childProduct->getkey()])) {
        //                 $result[$childProduct->getkey()] = [
        //                     'id' => $childProduct->getkey(),
        //                     'name' => $childProduct->name,
        //                     'sku' => $childProduct->sku,
        //                     'type' => $childProduct->type,
        //                     'price' => data_get($prices, $childProduct->getkey(), 0)
        //                 ];
        //             }
        //         }
        //     }
        // }
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
