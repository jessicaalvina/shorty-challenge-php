<?php
/**
 * Created by PhpStorm.
 * User: aashari
 * Date: 06/12/18
 * Time: 11.56
 */

namespace App\Http\Controllers\V2;


use App\Http\Controllers\Controller;
use App\Services\V2\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function updateById($id, Request $request, UserService $userService)
    {
        $data = $userService->updateById($id, $request->only([
            'name', 'email', 'address', 'phone'
        ]));
        return response()->json($data);
    }

}