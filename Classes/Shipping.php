<?php
namespace SendCloudClient;

use Curl\Curl;

class Shipping extends ObjectBase
{
    /**
     * @param string $address
     * @param string $city
     * @param string $house_number
     * @param string $postal_code
     * @param string $weight
     * @return string
     */
    public static function get_service_points_nearby(string $address, string $city, string $house_number,
                                                     string $postal_code, string $weight) : string
    {
        $curl = new Curl();

        Auth::BasicAuth($curl);

        $curl->get(SHIPPING_SERVICEPOINT_URL, [
            "country" => SERVICE_POINT_COUNTRY,
            "address" => $address,
            "carrier" => SERVICE_POINT_CARRIER,
            "city" => $city,
            "house_number" => $house_number,
            "postal_code" => $postal_code,
            "radius" => SERVICE_POINT_RADIUS,
            "weight" => $weight,
        ]);

        return self::get_response($curl);
    }

    /**
     * @param string $postal_code_recipient
     * @param string $weight
     * @return string
     */
    public static function get_shipping_products(string $postal_code_recipient, string $weight) : string
    {
        $curl = new Curl();

        Auth::BasicAuth($curl);

        $curl->get(SHIPPING_PRODUCTS_URL, [
            "carrier" => SERVICE_POINT_CARRIER,
            "country" => SERVICE_POINT_COUNTRY,
            "from_country" => SERVICE_POINT_COUNTRY,
            "weight_unit" => SERVICE_POINT_WEIGHT_UNIT,
            "to_postal_code" => $postal_code_recipient,
            "weight" => $weight,
        ]);

        return self::get_response($curl);
    }
}