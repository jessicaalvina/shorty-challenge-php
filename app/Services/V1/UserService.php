<?php
/**
 * Created by PhpStorm.
 * User: aashari
 * Date: 06/12/18
 * Time: 11.55
 */

namespace App\Services\V1;


use App\Repositories\V1\UserRepository;
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
     * @return \Illuminate\Database\Query\Builder|mixed
     */
    public function getById($id)
    {
        return $this->userRepository->getById($id);
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