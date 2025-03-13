<?php
///*
/// SendCloud Client Huushinne
/// *
namespace SendCloudClient
{
    use Curl\Curl;

    const CURLOPT_URL_CONST = "https://stoplight.io/mocks/sendcloud/sendcloud-public-api:v2/375423766/oauth2/token";
    const AUTH_CLIENT_ID = "";
    const AUTH_CLIENT_CODE = "";
    const AUTH_CLIENT_GRANT_TYPE = "";
    const AUTH_CLIENT_REDIRECT_URI = "";
    const AUTH_CLIENT_REFRESH_TOKEN = "";

    class SendCloudClient
    {
        private Curl $curl;
        private Auth $auth;

        function __construct($user, $password)
        {
            $this->curl = new Curl();

            $this->auth = new Auth();

            if (!is_null($resp = $this->auth->Auth($user, $password, $this->curl)))
            {
                var_dump($resp);

                $token = (new Token())->Setup($resp["access_token"], $resp["expires_in"], $resp["id_token"],
                            $resp["refresh_token"], $resp["scope"], $resp["token_type"]);

                var_dump($token);
            }
        }
    }
}