<?php
require 'geoip/vendor/autoload.php';
use GeoIp2\Database\Reader;

$reader = new Reader('geoip/GeoLite2-City.mmdb');

// Replace "city" with the appropriate method for your database, e.g.,
// "country".
$record = $reader->city($_SERVER['REMOTE_ADDR']);
$city = ["Beijing","Hebei","Sichuan","Jiangxi","Zhejiang","Anhui","Guangdong"];
$region = ["BJ","GD","AH"];

block($record, $city, $region);


function block($record, $city, $region){
    $req = $_SERVER['HTTP_HOST'];
    if(in_array($record->city->name,$city) || in_array($record->mostSpecificSubdivision->isoCode,$region)){
         echo "
        <script type=\"text/javascript\">
        window.location.href = './404.html'
        </script>
    ";
    }else{
        echo "
        <script type=\"text/javascript\">
        window.location.href = './mobie.html?$req'
        </script>
    ";

    }
}
