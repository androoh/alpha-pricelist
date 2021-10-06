<?php

namespace App\Http\Controllers;

use App\Models\PriceList;
use App\Models\Product;
use Illuminate\Http\Request;

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
        return view('priceList', [
            'priceList' => $priceList,
            'locale' => $locale,
            'pageSize' => $pageSize,
            'pageOrientation' => $pageOrientation,
            'showCropBorders' => $showCropBorders,
            'showCross' => $showCross
        ]);
    }
}
