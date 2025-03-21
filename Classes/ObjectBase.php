<?php

namespace SendCloudClient;

class ObjectBase
{
    /**
     * @param $curl
     * @return string
     */
    public static function get_response($curl) : string
    {
        $curl->close();

        return $curl->response;
    }
}