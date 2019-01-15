<?php
/**
 * Created by PhpStorm.
 * User: aashari
 * Date: 06/12/18
 * Time: 11.55
 */

namespace App\Services\V1;


use App\Repositories\V1\ShortyRepository;
use App\Services\Service;
use App\Constants\HTTPStatus;


class ShortyService extends Service
{

    private $shortyRepository;

    /**
     * ShortyService constructor.
     */
    public function __construct()
    {
        $this->shortyRepository = new ShortyRepository();
    }

    public function getByShortcode($shortcode)
    {   
        $return_obj = new \stdClass();
        $data = $this->shortyRepository->getByShortcode($shortcode);
        if ($data) {
            $data->redirect_count += 1;
            $data->last_seen_date = date("Y-m-d H:i:s");

            $newData = $this->shortyRepository->updateData($shortcode,$data);
            $return_obj->message = $newData->url;
            $return_obj->code = HTTPStatus::HTTP_OK;
            
        }  else {
            $return_obj->message = HTTPStatus::$statusTexts[404];
            $return_obj->code = HTTPStatus::HTTP_NOT_FOUND;
        }

        return $return_obj;
    }

    public function getByShortcodeStats($shortcode)
    {
        $data = $this->shortyRepository->getByShortcodeStats($shortcode);

        if ($data->redirect_count == 0)
        {
            return $this->shortyRepository->getByShortcodeStatsNoLastSeen($shortcode);
        } else 
        {
            return $data;
        }
    }

    public function postByShortcode($request)
    {
        $return_obj = new \stdClass();
        $match = preg_match("/^[0-9a-zA-Z_]{6}$/",$request['shortcode']);
        if ($match == 0) {
            $return_obj->message = HTTPStatus::$statusTexts[422];
            $return_obj->code = HTTPStatus::HTTP_UNPROCESSABLE_ENTITY;
            return $return_obj;
        }

        if (filter_var($request['url'], FILTER_VALIDATE_URL) === FALSE) {
            $return_obj->message = HTTPStatus::$statusTexts[400];
            $return_obj->code = HTTPStatus::HTTP_BAD_REQUEST;
            return $return_obj;
        }

        $return_obj->message = $this->shortyRepository->postByShortcode($request);
        $return_obj->code = HTTPStatus::HTTP_OK;
        return $return_obj;
    }
}