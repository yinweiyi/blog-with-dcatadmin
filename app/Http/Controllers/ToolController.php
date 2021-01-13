<?php


namespace App\Http\Controllers;


use App\Http\Requests\CreateHtmlToImageRequest;
use App\Services\ToolService;
use Illuminate\Http\Request;

class ToolController extends Controller
{

    public function htmlToImage(Request $request, ToolService $service)
    {
        $service->buildImageForUrl('blog.ewayee.com');
        //url width height
    }
}
