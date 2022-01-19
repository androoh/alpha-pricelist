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
        $result = [];
        $prices = data_get($priceList, 'prices', []);
        foreach(data_get($priceList, 'mainProductsPage.categories') as $treeItem) {
            $category = null;
            $categoryId = data_get($treeItem, 'category', null);
            if ($categoryId) {
                $category = \App\Models\Category::find($categoryId);
            }
            $categoryName = $category ? translateFromPath($category, 'name', null) : null;
            foreach (data_get($treeItem, 'main_products', []) as $product) {
                if ($productId = data_get($product, 'id', false)) {
                    if ($productModel = \App\Models\Product::find($productId)) {
                        if ($productModel->child_product_ids) {
                            $childProducts = Product::find($productModel->child_product_ids);
                            foreach ($childProducts as $childProduct) {
                                $priceKey = getPriceKey($categoryId, $productModel->getKey(), $childProduct->getkey());
                                $priceId = getPriceKey($childProduct->getkey(), $productModel->getKey(), $categoryId);
                                if (!isset($result[$priceKey])) {
                                    $name = [];
                                    if ($categoryName) {
                                        $name[] = $categoryName;
                                    }
                                    $name[] = translateFromPath($productModel, 'name', '');
                                    $name[] = translateFromPath($childProduct, 'name', '');
                                    $result[$priceKey] = [
                                        'id' => $priceKey,
                                        'name' =>  implode(' -> ', $name),
                                        'sku' => $childProduct->sku,
                                        'type' => $childProduct->type,
                                        // 'price' => [
                                        //     'value' => data_get($prices, $product->getKey() . '#' . $childProduct->getkey(), 0),
                                        //     'onDemand' => false,
                                        // ],
                                        'price' => data_get($prices, $priceKey, 0)
                                    ];
                                }
                            }
                        }
                    }
                }
            }
            $productSections = data_get($treeItem, 'product_options_sections', []);
            $this->getFromProductSections($result, $category, $productSections, $prices);
        }
        $productSections = data_get($priceList, 'optionsAndAccessoriesPage.product_options_sections', false);
        $this->getFromProductSections($result, null, $productSections, $prices);
        return response([
            'defaultLocale' => config('app.locale'),
            'data' => array_values($result)
        ]);
    }

    private function getFromProductSections(&$result, $category, $productSections, $prices)
    {
        foreach ($productSections as $productSection) {
            foreach(data_get($productSection, 'product_option_sections', []) as $productOptionSection) {
                foreach(data_get($productOptionSection, 'product_options', []) as $productOption) {
                    $productOptionId = data_get($productOption, 'id', false);
                    if ($productOptionId) {
                        $productOptionData = \App\Models\Product::find($productOptionId);
                        $priceKey = getPriceKey($category, $productOptionData->getKey());
                        $name = [];
                        if ($category) {
                            $name[] = translateFromPath($category, 'name', '');
                        }
                        if ($title = translateFromPath($productSection, 'title', '')) {
                            $name[] = $title;
                        }
                        $name[] = translateFromPath($productOptionData, 'name');
                        $result[$priceKey] = [
                            'id' => $priceKey,
                            'name' =>  implode(' -> ', $name),
                            'sku' => $productOptionData->sku,
                            'type' => $productOptionData->type,
                            // 'price' => [
                            //     'value' => data_get($prices, $productOptionData->getkey(), 0),
                            //     'onDemand' => false,
                            // ],
                            'price' => data_get($prices, $priceKey, 0)
                        ];
                    }
                }
            }
        }
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
