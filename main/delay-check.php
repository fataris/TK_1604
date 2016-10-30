<?php
require_once "index.php";
require_once "con-train-info.php";
require_once "phpOsc/oscSender.php";

error_reporting(0);


while (true) {
        $delayCheck = con_train_info($GLOBALS["startPoint"], $GLOBALS["destination"], $GLOBALS["year"], $GLOBALS["month"], $GLOBALS["day"], $GLOBALS["hour"], $GLOBALS["minuteTens"], $GLOBALS["minuteOnes"]);
        var_dump($GLOBALS["startPoint"]);
        var_dump($delayCheck);
        sendOsc("/delay", (int)$delayCheck);
        echo "確認してきましたよ！頑張りました！";
        echo $delayCheck;
        sleep(10);
}
