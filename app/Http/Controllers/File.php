<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File as FileModel;
use Intervention\Image\Facades\Image;

class File extends Controller
{
    const FILES_PATH = 'upload';
    /**
     * Upload file.
     * @param ResourceRequest $request
     * @param string $resourceName
     * @return string
     */
    public function uploadFile(Request $request)
    {
        $uploadedFile = $request->file('file');
        $newFilename = time() . '-' . $this->removeSpecialChar($uploadedFile->getClientOriginalName());
        Storage::disk('local')->putFileAs(
            self::FILES_PATH,
            $uploadedFile,
            $newFilename
        );
        $file = FileModel::create([
            'fileSize' => $uploadedFile->getSize(),
            'storage' => 'local',
            'path' => self::FILES_PATH . '/' . $newFilename,
            'originalName' => $uploadedFile->getClientOriginalName(),
            'fileName' => $newFilename,
            'mimeType' => $uploadedFile->getMimeType(),
            'extension' => $uploadedFile->getExtension()
        ]);
        return response([
            'id' => $file->getKey(),
            'oldName' => $uploadedFile->getClientOriginalName(),
            'name' => $newFilename,
            'storage' => 'local',
            'path' => self::FILES_PATH . '/' . $newFilename
        ]);
    }

    function removeSpecialChar($str){
        return preg_replace('/[^a-z0-9\_\-\.]/i',' ', $str);
    }

    public function getFileById(Request $request, $id)
    {
        $file = FileModel::find($id);
        if ($file) {
            return Storage::response($file->path);
        }
        return response('Resource not found', 404);
    }

    public function getFileByFilename(Request $request, $filename)
    {
        if (Storage::exists(self::FILES_PATH . '/' . $filename)) {
            $img = Image::make(Storage::path(self::FILES_PATH . '/' . $filename))->resize(800, 600);

            return $img->response('jpg');
//            return Storage::response(self::FILES_PATH . '/' . $filename);
        }
        return response('Resource not found', 404);
    }
}
