<?php
namespace SendCloudClient
{
    class Auth
    {
        function Auth($user, $password, $curl) : ?string
        {
            $curl->setHeader('Authorization', 'Basic ' . base64_encode("$user:$password"));

            curl_setopt_array($curl, [
                CURLOPT_URL => CURLOPT_URL_CONST,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "client_id=" . AUTH_CLIENT_ID . "&code=" . AUTH_CLIENT_CODE
                                        . "&grant_type=" . AUTH_CLIENT_GRANT_TYPE . "&redirect_uri=" . AUTH_CLIENT_REDIRECT_URI
                                        . "&refresh_token=" . AUTH_CLIENT_REFRESH_TOKEN,
                CURLOPT_HTTPHEADER => [
                    "Accept: application/json",
                    "Authorization: Basic 123",
                    "Content-Type: application/x-www-form-urlencoded"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err)
            {
                return $err;
            }
            else
            {
                return $response;
            }
        }
    }
}