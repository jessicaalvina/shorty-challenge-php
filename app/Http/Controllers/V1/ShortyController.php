<?php

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Services\V1\ShortyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ShortyController extends Controller
{
    public function getByShortcode($shortcode, ShortyService $shortyService)
    {
        $data = $shortyService->getByShortcode($shortcode);

        if ($data->code == 200) {
            return redirect()->to($data->message);
        } else {
            return response()->json($data->message, $data->code);
        }
    }

    public function getByShortcodeStats($shortcode, ShortyService $shortyService)
    {
        $data = $shortyService->getByShortcodeStats($shortcode);
        return response()->json($data);
    }

    public function postByShortcode(Request $request, shortyService $shortyService)
    {
        $input = $request->all();
        $params = [
            'shortcode' => $input['shortcode'],
            'url' => $input['url']
        ];
        $return_obj = $shortyService->postByShortcode($params);
      
        return response()->json($return_obj->message, $return_obj->code);
    }
}