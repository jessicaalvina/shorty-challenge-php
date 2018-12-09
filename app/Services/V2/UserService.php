<?php
/**
 * Created by PhpStorm.
 * User: aashari
 * Date: 06/12/18
 * Time: 11.56
 */

namespace App\Services\V2;


use App\Repositories\V2\UserRepository;
use App\Services\Service;

class UserService extends Service
{

    private $userRepository;

    /**
     * UserService constructor.
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * @param $id
     * @param $data
     * @return int
     */
    public function updateById($id, $data)
    {
        return $this->userRepository->updateById($id, $data);
    }

}