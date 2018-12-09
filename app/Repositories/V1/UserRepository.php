<?php
/**
 * Created by PhpStorm.
 * User: aashari
 * Date: 06/12/18
 * Time: 11.50
 */

namespace App\Repositories\V1;

use App\Repositories\Repository;

class UserRepository extends Repository
{

    /**
     * @param $id
     * @param bool $includeDeleted
     * @return \Illuminate\Database\Query\Builder|mixed
     */
    public function getById($id)
    {
        return \DB::table('users')
            ->where('id', $id)
            ->first();
    }

    /**
     * @param $email
     * @param bool $includeDeleted
     * @return \Illuminate\Database\Query\Builder|mixed
     */
    public function getByEmail($email)
    {
        return \DB::table('users')
            ->where('email', $email)
            ->first();
    }

    /**
     * @param $id
     * @param $newData
     * @return int
     */
    public function updateById($id, $newData)
    {
        \DB::table('users')
            ->where('id', $id)
            ->update((array)$newData);
        return $this->getById($id);
    }

}