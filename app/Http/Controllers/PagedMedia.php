<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PriceList;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ResourceRequest;

class PagedMedia extends Controller
{
    protected $pageSizes = [
        'A0',
        'A1',
        'A2',
        'A3',
        'A5',
        'A6',
        'A7',
        'A10',
        'B4',
        'B5',
        'letter',
        'legal',
        'ledger'
    ];

    public function html(Request $request)
    {
        $locale = $request->query('locale', config('app.locale'));
        $pageSize = $request->query('pageSize', 'A4');
        $pageOrientation = $request->query('pageOrientation', 'portrait');
        $showCropBorders = $request->query('showCropBorders');
        $showCropBorders = $showCropBorders === 'true';
        $showCross = $request->query('showCross');
        $showCross = $showCross === 'true';
        $priceList = PriceList::find('6109a81ec49f065d5b658576');
        config(['app.template.locale' => $locale]);
        return view('pricelist', [
            'priceList' => $priceList,
            'locale' => $locale,
            'pageSize' => $pageSize,
            'pageOrientation' => $pageOrientation,
            'showCropBorders' => $showCropBorders,
            'showCross' => $showCross
        ]);
    }

    public function category(Request $request)
    {
        $locale = $request->query('locale', config('app.locale'));
        $pageSize = $request->query('pageSize', 'A4');
        $pageOrientation = $request->query('pageOrientation', 'portrait');
        $showCropBorders = $request->query('showCropBorders');
        $showCropBorders = $showCropBorders === 'true';
        $showCross = $request->query('showCross');
        $showCross = $showCross === 'true';
        $treeItem = $request->input('content', null);
        $treeItem = json_decode($treeItem, true);
        config(['app.template.locale' => $locale]);
        return view('category-preview', [
            'priceList' => null,
            'treeItem' => $treeItem,
            'locale' => $locale,
            'pageSize' => $pageSize,
            'pageOrientation' => $pageOrientation,
            'showCropBorders' => $showCropBorders,
            'showCross' => $showCross
        ]);
    }

    public function opetionSection(Request $request)
    {

    }

    public function renderResource(ResourceRequest $request, $resourceName, $id)
    {
        $resource = $request->getResource($resourceName);
        $model = $resource::model();
        $resourceData = $model::find($id);
        $locale = $request->query('locale', config('app.locale'));
        $pageSize = $request->query('pageSize', 'A4');
        $pageOrientation = $request->query('pageOrientation', 'portrait');
        $showCropBorders = $request->query('showCropBorders');
        $showCropBorders = $showCropBorders === 'true';
        $showCross = $request->query('showCross');
        $showCross = $showCross === 'true';
        $path = $request->query('path', null);
        $template = $request->query('template', null);
        config(['app.template.locale' => $locale]);
        if (!$template) {
            throw new \Exception('Template not specified');
        }
        $treeItem = data_get($resourceData, $path, null);

        return view('template-preview', [
            'resourceData' => $resourceData,
            'treeItem' => $treeItem,
            'template' => $template,
            'locale' => $locale,
            'pageSize' => $pageSize,
            'pageOrientation' => $pageOrientation,
            'showCropBorders' => $showCropBorders,
            'showCross' => $showCross
        ]);
    }
}
