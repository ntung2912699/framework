<?php
namespace libs;
use resource\Template;
require '../resource/View/templateengine/tempengine.php';
class BaseController extends Template{

    const VIEW_FOLDER = __DIR__ . '/../resource/View';

    protected function view($viewPath, $data = [])
    {
        foreach ($data as $key => $value) {
            //$$ = Khai báo biến + key
            $$key = $value;
        }

        return require_once (self::VIEW_FOLDER . '/' . str_replace(".",'/',$viewPath) . '.php');
    }
}