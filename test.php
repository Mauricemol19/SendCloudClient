<?php
require_once "SendCloudClient.php";

use SendCloudClient\SendCloudClient;

const CLIENT_USERNAME = "user";
const CLIENT_PASSWORD = "password";

echo "<pre>";

$client = new SendCloudClient(CLIENT_USERNAME, CLIENT_PASSWORD);

echo "</pre>";

echo "<pre>";

//var_dump(json_decode($client->get_parcel(2235)));

echo "</pre>";

echo "<pre>";

//var_dump($client->get_parcel_label(2235));

echo "</pre>";

echo "<pre>";

//var_dump(json_decode($client->get_service_points("Eendenveld","Emmen", "20", "7827LA", "2")));
echo "</pre>";

echo "<pre>";

var_dump(json_decode($client->get_shipping_products("7827LA", "0")));

echo "</pre>";
