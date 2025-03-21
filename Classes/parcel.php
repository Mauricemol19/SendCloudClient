<?php
namespace SendCloudClient;

use Curl\Curl;

class parcel extends ObjectBase
{
    /**
     * @param string $name
     * @param string $address
     * @param string $house_number
     * @param string $city
     * @param string $postal_code
     * @param string $telephone
     * @param bool $request_label
     * @return string
     */
    public static function create_parcel(string $name, string $address, string $house_number, string $city,
                                         string $postal_code, string $telephone, bool $request_label) : string
    {
        $curl = new Curl();

        Auth::BasicAuth($curl);

        $curl->post(PARCEL_URL, [
            "parcel" => [
                "name" => $name,
                "address" => $address,
                "house_number" => $house_number,
                "city" => $city,
                "postal_code" => $postal_code,
                "telephone" => $telephone,
                "request_label" => $request_label
            ]
        ]);

        return self::get_response($curl);
    }

    /**
     * @param string $parcel_id
     * @return string
     */
    public static function get_parcel(string $parcel_id) : string
    {
        $curl = new Curl();

        Auth::BasicAuth($curl);

        $curl->get(PARCEL_URL . $parcel_id, [
            //"Token" => SendCloudClient::$token->access_token
        ]);

        return self::get_response($curl);
    }

    /**
     * @param string $parcel_id
     * @return string
     */
    public static function get_parcel_label(string $parcel_id) : string
    {
        $curl = new Curl();

        $curl->get(PARCEL_PDF_URL . $parcel_id, [
            //"Token" => SendCloudClient::$token->access_token
        ]);

        return self::get_response($curl);
    }

    public static function get_parcel_labelprinter_label($parcel_id)
    {

    }

    public static function cancel_parcel($parcel_id)
    {

    }

    public static function get_parcel_statuses()
    {

    }

}