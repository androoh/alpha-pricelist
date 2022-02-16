<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use Illuminate\Http\Request;

class Translations extends Controller
{

    public function index(Request $request)
    {
        return response(
            [
                'defaultLocale' => config('app.locale'),
                'locales' => config('app.locales'),
                'translations' => Translation::all()
            ]
        );
    }

    public function store(Request $request)
    {
        $translations = $request->input('translations', []);
        if ($translations) {
            foreach ($translations as $translation) {
                $translationModel = null;
                if (isset($translation['_id']) && $translation['_id']) {
                    $translationModel = Translation::find($translation['_id']);
                }
                if (!$translationModel) {
                    $translationModel = new Translation();
                }
                $translationModel->key = $translation['key'];
                $translationModel->text = $translation['text'];
                $translationModel->group = $translation['group'] ?? '*';
                $translationModel->save();
            }
        }
        response(['ok']);
    }
}
