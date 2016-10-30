<?php
$url =  "http://transit.yahoo.co.jp/search/result?flatlon=&from=${startPoint}&tlatlon=&to=${destination}&via=&via=&via=&y=${year}&m=${month}&d=${day}&hh=${hour}&m1=${minuteTens}&m2=${minuteOnes}&type=4&ticket=ic&al=1&shin=1&ex=1&hb=1&lb=1&sr=1&s=0&expkind=1&ws=2&kw=${destination}";


function get_train_time($startPoint, $destination, $year, $month, $day, $hour, $minuteTens, $minuteOnes) {


$url =  "http://transit.yahoo.co.jp/search/result?flatlon=&from=${startPoint}&tlatlon=&to=${destination}&via=&via=&via=&y=${year}&m=${month}&d=${day}&hh=${hour}&m1=${minuteTens}&m2=${minuteOnes}&type=4&ticket=ic&al=1&shin=1&ex=1&hb=1&lb=1&sr=1&s=0&expkind=1&ws=2&kw=${destination}";

//var_dump($url);
//$url = "http://transit.yahoo.co.jp/search/result?flatlon=&from=%E6%9D%89%E7%94%B0&tlatlon=&to=%E5%93%81%E5%B7%9D&via=&via=&via=&y=2016&m=10&d=30&hh=20&m1=0&m3=1&type=4&ticket=ic&al=1&shin=1&ex=1&hb=1&lb=1&sr=1&s=0&expkind=1&ws=2&kw=%E5%93%81%E5%B7%9D";

$trainWayHtml = file_get_contents($url);
$trainRaws = explode("\n", $trainWayHtml);

for($i = 0; $i < count($trainRaws)-1; $i++) {
    //route01を検索
    $pos = strpos($trainRaws[$i], "route01");
    if ($pos !== false) {
        for($n = 0; $n < 30; $n++) {
            //発を検索
            $pos = strpos($trainRaws[$i + $n], "発");
            if($pos !== false) {
                $timeLine = strstr($trainRaws[$i + $n], "発", true);
                if (strpos($timeLine, '[!]')) {
                    $timeLine = str_replace('[!]', '', $timeLine);
                }
                $trainTime = strip_tags($timeLine);
                $time = explode(":", $trainTime);
                return $time;
                break 2;
            } elseif ($n == 30)  {
                return "何かがちんちん";
                break 2;
            }
        }
    }
}
}
