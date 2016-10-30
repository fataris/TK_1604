<?php
include_once "index.php";
include_once "get_train_time.php";

$url = "http://transit.yahoo.co.jp/search/result?flatlon=&from=${startPoint}&tlatlon=&to=${destination}&via=&via=&via=&y=${year}&m=${month}&d=${day}&hh=${hour}&m1=${minuteTens}&m2=${minuteOnes}&type=4&ticket=ic&al=1&shin=1&ex=1&hb=1&lb=1&sr=1&s=0&expkind=1&ws=2&kw=${destination}";

function con_train_info($startPoint, $destination, $year, $month, $day, $hour, $minuteTens, $minuteOnes) {

$url = "http://transit.yahoo.co.jp/search/result?flatlon=&from=${startPoint}&tlatlon=&to=${destination}&via=&via=&via=&y=${year}&m=${month}&d=${day}&hh=${hour}&m1=${minuteTens}&m2=${minuteOnes}&type=4&ticket=ic&al=1&shin=1&ex=1&hb=1&lb=1&sr=1&s=0&expkind=1&ws=2&kw=${destination}";

var_dump($url);

$trainWayHtml = file_get_contents($url);
//htmlデータを一行ずつわけて保存
$trainRaws = explode("\n", $trainWayHtml);

for($i = 0; $i < count($trainRaws)-1; $i++) {
    //第一候補を検索
    $pos = strpos($trainRaws[$i], "elmRouteDetail");
    if ($pos !== false) {
        for($n = 0; $n < 600; $n++) {
            //icnAlertを検索
            $pos = strpos($trainRaws[$i + $n], "icnAlert");
            if($pos !== false) {
                //遅延しているかどうか
                $pos = strpos($trainRaws[$i + $n], "遅延");
                if($pos !== false) {
                    echo 1;
                    return 1; //遅延していたら1
                    break 2;
                } else {
                    $pos = strpos($trainRaws[$i + $n], "運休");
                    if($pos !== false) {
                        echo 2;
                        return 2; //運休していたら2
                        break 2;
                    } else {
                        echo 2;
                        return 2; //何かがおかしいので2
                        break 2;
                    }
                }
            } else {
                echo 0;
                return 0; //平常通りなら0
                break 2;
            }
        }
    }
}
}

while (true) {
        $delayCheck = con_train_info($GLOBALS["startPoint"], $GLOBALS["destination"], $GLOBALS["year"], $GLOBALS["month"], $GLOBALS["day"], $GLOBALS["hour"], $GLOBALS["minuteTens"], $GLOBALS["minuteOnes"]);
        var_dump($GLOBALS["startPoint"]);
        var_dump($delayCheck);
        sendOsc("/delay", (int)$delayCheck);
        echo "確認してきましたよ！頑張りました！";
        echo $delayCheck;
        sleep(10);
}
