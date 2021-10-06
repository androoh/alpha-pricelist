<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File as FileModel;

class File extends Controller
{
    const FILES_PATH = 'images';
    /**
     * Upload file.
     * @param ResourceRequest $request
     * @param string $resourceName
     * @return string
     */
    public function uploadFile(Request $request)
    {
        $uploadedFile = $request->file('file');
        $filename = $uploadedFile->getClientOriginalName();
        $newFilename = time() . '-' . $filename;
        Storage::disk('local')->putFileAs(
            self::FILES_PATH,
            $uploadedFile,
            $newFilename
        );
        $file = FileModel::create([
            'fileSize' => $uploadedFile->getSize(),
            'storage' => 'local',
            'path' => self::FILES_PATH . '/' . $newFilename,
            'originalName' => $filename,
            'fileName' => $newFilename,
            'mimeType' => $uploadedFile->getMimeType(),
            'extension' => $uploadedFile->getExtension()
        ]);
        return response([
            'id' => $file->getKey(),
            'oldName' => $filename,
            'name' => $newFilename,
            'storage' => 'local',
            'path' => self::FILES_PATH . '/' . $newFilename,
            'url' => route('get_file_by_name', ['filename' => $newFilename], false)
        ]);
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
            return Storage::response(self::FILES_PATH . '/' . $filename);
        }
        return response('Resource not found', 404);
    }
}
