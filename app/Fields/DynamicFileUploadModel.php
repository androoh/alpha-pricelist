<?php


namespace App\Fields;


class DynamicFileUploadModel extends DynamicFileControlModel
{
    const DYNAMIC_FORM_CONTROL_TYPE_FILE_UPLOAD = "FILE_UPLOAD";
    public $type = self::DYNAMIC_FORM_CONTROL_TYPE_FILE_UPLOAD;
    public $accept;
    public $autoUpload;
    public $maxSize;
    public $minSize;
    public $removeUrl;
    public $showFileList;
    public $url;
}
