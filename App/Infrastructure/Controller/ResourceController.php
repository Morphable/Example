<?php

namespace App\Infrastructure\Controller;

use App\Infrastructure\Application;

class ResourceController
{
    public static function serve($req, $res)
    {
        if ($req->getParam('type') == 'css') {
            header('Content-type: text/css');

            return $res->sendResponse(
                file_get_contents(Application::getPath('public') . '/resources/dist/main.css')
            );
        } elseif ($req->getParam('type') == 'js') {
            header('Content-type: text/js');

            return $res->sendResponse(
                file_get_contents(Application::getPath('public') . '/resources/dist/main.js')
            );
        }

        return $res->sendResponse("", 404);
    }
}
