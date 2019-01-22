<?php
function ip_in_range($ip, $range) {
    if (strpos($range, '/') == false)
        $range .= '/32';
    list($range, $netmask) = explode('/', $range, 2);
    $range_decimal = ip2long($range);
    $ip_decimal = ip2long($ip);
    $wildcard_decimal = pow(2, (32 - $netmask)) - 1;
    $netmask_decimal = ~ $wildcard_decimal;
    return (($ip_decimal & $netmask_decimal) == ($range_decimal & $netmask_decimal));
}

function _cloudflare_CheckIP($ip) {
//https://www.cloudflare.com/ips-v4
$cf_ips = array(
'103.21.244.0/22',
'103.22.200.0/22',
'103.31.4.0/22',
'104.16.0.0/12',
'108.162.192.0/18',
'131.0.72.0/22',
'141.101.64.0/18',
'162.158.0.0/15',
'172.64.0.0/13',
'173.245.48.0/20',
'188.114.96.0/20',
'190.93.240.0/20',
'197.234.240.0/22',
'198.41.128.0/17',
);
    $is_cf_ip = false;
    foreach ($cf_ips as $cf_ip) {
        if (ip_in_range($ip, $cf_ip)) {
            $is_cf_ip = true;
            break;
        }
    } return $is_cf_ip;
}

function _cloudflare_Requests_Check() {
    $flag = true;

    if(!isset($_SERVER['HTTP_CF_CONNECTING_IP']))   $flag = false;
    if(!isset($_SERVER['HTTP_CF_IPCOUNTRY']))       $flag = false;
    if(!isset($_SERVER['HTTP_CF_RAY']))             $flag = false;
    if(!isset($_SERVER['HTTP_CF_VISITOR']))         $flag = false;
    return $flag;
}

function isCloudflare() {
    $ipCheck        = _cloudflare_CheckIP($_SERVER['REMOTE_ADDR']);
    $requestCheck   = _cloudflare_Requests_Check();
    return ($ipCheck && $requestCheck);
}

function getRequestIP() {
    $check = isCloudflare();

    if($check) {
        return $_SERVER['HTTP_CF_CONNECTING_IP'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

$ip = getRequestIP();
$cf = isCloudflare();

if($cf) echo "Cloudflare<br>";
else    echo "Cloudflare değil";
echo $_SERVER['REMOTE_ADDR']."<br>";
echo "Gerçek IP: ". $ip;
?>