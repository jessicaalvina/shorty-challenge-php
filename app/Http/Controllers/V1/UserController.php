<?php
/**
 * Created by PhpStorm.
 * User: aashari
 * Date: 06/12/18
 * Time: 11.50
 */

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;
use App\Services\V1\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @param $id
     * @param UserService $userService
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById($id, UserService $userService)
    {
        $data = $userService->getById($id);
        return response()->json($data);
    }

    /**
     * @param $id
     * @param Request $request
     * @param UserService $userService
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateById($id, Request $request, UserService $userService)
    {
        $data = $userService->updateById($id, $request->only([
            'name', 'email', 'address', 'phone'
        ]));
        return response()->json($data);
    }

}