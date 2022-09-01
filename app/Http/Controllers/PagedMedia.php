<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PriceList;
use App\Models\Product;
use App\Models\PricelistProcessing;
use Illuminate\Http\Request;
use App\Http\Requests\ResourceRequest;
use App\Jobs\GeneratePdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

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

    public function getPdfUrl($id, $language = 'en')
    {
        $processKey = PricelistProcessing::PRICELIST_TO_PDF_KEY . '-' . $language . '-' . $id;
        $processing = PricelistProcessing::where('resourceKey', $processKey)->first();
        if ($processing) {
            if ($processing->status === PricelistProcessing::STATUS_SUCCESS) {
                $path = "/pdf/pricelist-{$language}-{$id}.pdf";
                if (Storage::exists($path)) {
                    return ['status' => 'success', 'url' => config('app.url') .$path];
                }
            }
            return ['status' => $processing->status];
        }
        return ['status' => PricelistProcessing::STATUS_FAILED];
    }

    public function renderPdfResource($id, $language = 'en')
    {
        $processKey = PricelistProcessing::PRICELIST_TO_PDF_KEY . '-' . $language . '-' . $id;
        $processing = PricelistProcessing::where('resourceKey', $processKey)->first();
        if (!$processing || $processing->status !== PricelistProcessing::STATUS_PROGRESS) {
            $priceList = PriceList::find($id);
            if ($priceList) {
                if (!$processing) {
                    $processing = PricelistProcessing::create(['resourceKey' => $processKey, 'status' => PricelistProcessing::STATUS_PROGRESS]);
                } else {
                    $processing->status = PricelistProcessing::STATUS_PROGRESS;
                    $processing->save();
                }
                GeneratePdf::dispatch($priceList, $processing, $language)->onQueue('pdf-processing');
            }
        }
        return ['processing' => $processing];
    }

    public function renderResource(ResourceRequest $request, $resourceName, $id)
    {
        $resource = $request->getResource($resourceName);
        $model = $resource::model();
        $resourceData = $model::find($id);
        $locale = $request->query('locale', config('app.fallback_locale'));
        $pageSize = $request->query('pageSize', 'A4');
        $pageOrientation = $request->query('pageOrientation', 'portrait');
        $showCropBorders = $request->query('showCropBorders');
        $showCropBorders = $showCropBorders === 'true';
        $showCross = $request->query('showCross');
        $showCross = $showCross === 'true';
        $path = $request->query('path', null);
        $template = $request->query('template', null);
        $ignorePagedjs = $request->query('ignorePagedjs', false);
        config(['app.template.locale' => $locale]);
        if (!$template) {
            throw new \Exception('Template not specified');
        }
        $treeItem = data_get($resourceData, $path, null);
        App::setLocale($locale);
        return view('template-preview', [
            'ignorePagedjs' => $ignorePagedjs,
            'resourceData' => $resourceData,
            'treeItem' => $treeItem,
            'template' => $template,
            'locale' => $locale,
            'pageSize' => $pageSize,
            'pageOrientation' => $pageOrientation,
            'showCropBorders' => $showCropBorders,
            'showCross' => $showCross,
            'hidePrices' => data_get($resourceData, 'hidePrices', false)
        ]);
    }
}
