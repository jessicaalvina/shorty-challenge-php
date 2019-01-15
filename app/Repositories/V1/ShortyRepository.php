<?php

namespace App\Repositories\V1;

use App\Repositories\Repository;

class ShortyRepository extends Repository
{
    public function getByShortcode($shortcode)
    {

        return \DB::table('shorty')
            ->where('shortcode', $shortcode)
            ->first();
    }

    public function updateData($shortcode, $data)
    {
        \DB::table('shorty')
            ->where('shortcode', $shortcode)
            ->update((array)$data);
        return $this->getByShortcode($shortcode);
    }

    public function getByShortcodeStats($shortcode)
    {
        return \DB::table('shorty')
            ->where('shortcode', $shortcode)
            ->first(['last_seen_date', 'redirect_count', 'start_date']);
    }

    public function getByShortcodeStatsNoLastSeen($shortcode)
    {
        return \DB::table('shorty')
            ->where('shortcode', $shortcode)
            ->first(['redirect_count', 'start_date']);
    }


    public function postByShortcode($request)
    {
        $shortcode = $request['shortcode'];
        $url = $request['url'];
        \DB::table('shorty')
            ->insert(['shortcode' => $shortcode, 'url' => $url]);
        
        $return_obj = new \stdClass();
        $return_obj->shortcode = $shortcode;
        return $return_obj;
    }

}