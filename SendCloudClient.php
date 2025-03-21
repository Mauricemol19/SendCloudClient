<?php
/**
* SendCloud Client Huushinne
*/
namespace SendCloudClient
{
    require_once "vendor/autoload.php";

    require_once "classes/ObjectBase.php";
    require_once "classes/Auth.php";
    require_once "classes/Parcel.php";
    require_once "classes/Shipping.php";

    require_once "classes/enums/Token.php";

    /* O2Auth */
    const O2AUTH_URL = "https://stoplight.io/mocks/sendcloud/sendcloud-public-api:v2/375423766/oauth2/token";
    const AUTH_CLIENT_ID = "1234567890";
    const AUTH_CLIENT_CODE = "1234567890";
    const AUTH_CLIENT_GRANT_TYPE = "api";
    const AUTH_CLIENT_REDIRECT_URI = "";
    const AUTH_CLIENT_REFRESH_TOKEN = "";

    /* URL's */
    const URL_BASE = "https://stoplight.io/mocks/sendcloud/sendcloud-public-api:v2/";
    const PARCEL_URL = URL_BASE . "299107074/parcels/";
    const PARCEL_PDF_URL = URL_BASE . "299107071/labels/normal_printer/";
    const SHIPPING_SERVICEPOINT_URL = URL_BASE . "299107080/service-points";
    const SHIPPING_PRODUCTS_URL = URL_BASE . "299107083/shipping-products";

    /* Settings */
    const SERVICE_POINT_CARRIER = "postnl";
    const SERVICE_POINT_RADIUS = 50000;
    const SERVICE_POINT_COUNTRY = "NL";
    const SERVICE_POINT_WEIGHT_UNIT = "kilogram";

    class SendCloudClient
    {
        /**
         * @var Token
         */
        public static Token $token;

        public static string $username;
        public static string $password;

        /**
         * @param string $user
         * @param string $password
         */
        function __construct(string $user, string $password)
        {
            self::$username = $user;
            self::$password = $password;

            /* O2Auth */
            if (!is_null($resp = Auth::Instantiate($user, $password)))
            {
                $resp = json_decode($resp);

                self::$token = (new Token())->Setup($resp->access_token, $resp->expires_in, $resp->id_token,
                            $resp->refresh_token, $resp->scope, $resp->token_type);
            }
            else
            {
                echo "Unable to authenticate via O2Auth; possible connection failure";
                exit();
            }
        }

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
        public function Create_parcel(string $name, string $address, string $house_number, string $city, string $postal_code, string $telephone, bool $request_label) : string
        {
            return Parcel::create_parcel($name, $address, $house_number, $city, $postal_code, $telephone, $request_label);
        }

        /**
         * @param string $parcel_id
         * @return string
         */
        public function get_parcel(string $parcel_id) : string
        {
            return Parcel::get_parcel($parcel_id);
        }

        /**
         * @param string $parcel_id
         * @return string
         */
        public function get_parcel_label(string $parcel_id) : string
        {
            return Parcel::get_parcel_label($parcel_id);
        }

        /**
         * @param string $address
         * @param string $city
         * @param string $house_number
         * @param string $postal_code
         * @param string $weight
         * @return string
         */
        public function get_service_points(string $address, string $city, string $house_number, string $postal_code, string $weight) : string
        {
            return Shipping::get_service_points_nearby($address, $city, $house_number, $postal_code, $weight);
        }

        /**
         * @param string $postal_code_recipient
         * @param string $weight
         * @return string
         */
        public function get_shipping_products(string $postal_code_recipient, string $weight) : string
        {
            return Shipping::get_shipping_products($postal_code_recipient, $weight);
        }

        public function get_list_sender_addresses()
        {

        }
    }
}
