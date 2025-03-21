<?php
namespace SendCloudClient
{

    use Curl\Curl;

    class Auth
    {
        /**
         * @param $user
         * @param $password
         * @return string|null
         */
        public static function Instantiate($user, $password) : ?string
        {
            $curl = new Curl();

            $curl->setBasicAuthentication($user, $password);
            $curl->SetUserAgent("");
            $curl->setHeader("X-Requested-With", "XMLHttpRequest");
            //$curl->setHeader("Prefer:", "code=200, dynamic=true");

            $curl->post(O2AUTH_URL, [
                "client_id" => AUTH_CLIENT_ID,
                "code" => AUTH_CLIENT_CODE,
                "grant_type" => AUTH_CLIENT_GRANT_TYPE,
                "redirect_uri" => AUTH_CLIENT_REDIRECT_URI,
                "refresh_token" => AUTH_CLIENT_REFRESH_TOKEN,
            ]);

            $curl->close();

            if ($curl->error_code)
            {
                return $curl->error_code;
            }
            else
            {
                return $curl->response;
            }
        }

        /**
         * @param $curl
         * @return Curl
         */
        public static function BasicAuth($curl) : Curl
        {
            $curl->setHeader('Content-Type', 'application/json');
            $curl->setHeader('Authorization', 'Basic ' . base64_encode(SendCloudClient::$username . ':' . SendCloudClient::$password));
            $curl->setHeader("Prefer", "code=200, dynamic=false");

            return $curl;
        }
    }
}
