<?php
require "get-train-time.php";
require "phpOsc/oscSender.php";


if(isset($_GET['startPoint'])){
    $startPoint = $_GET['startPoint'];
}

if(isset($_GET['destination'])){
    $destination = $_GET['destination'];
    //var_dump($destination);
}
if(isset($_GET['year'])){
    $year = $_GET['year'];
    //var_dump($year);
}
if(isset($_GET['month'])){
    $month = $_GET['month'];
    //var_dump($month);
}
if(isset($_GET['day'])){
    $day = $_GET['day'];
    //var_dump($day);
}
if(isset($_GET['hour'])){
    $hour = $_GET['hour'];
    //var_dump($hour);
}
if(isset($_GET['minuteTens'])){
    $minuteTens = $_GET['minuteTens'];
    //var_dump($minuteTens);
}
if(isset($_GET['minuteOnes'])){
    $minuteOnes = $_GET['minuteOnes'];
    //var_dump($minuteOnes);
}
if ( ! (empty($startPoint))) {
   $url =  "http://transit.yahoo.co.jp/search/result?flatlon=&from=" . $startPoint . "&tlatlon=&to=" . $destination . "&via=&via=&via=&y=" . $year . "&m=" . $month . "&d=" . $day . "&hh=" . $hour . "&m1=" . $minuteTens . "&m2=" . $minuteOnes . "&type=4&ticket=ic&al=1&shin=1&ex=1&hb=1&lb=1&sr=1&s=0&expkind=1&ws=2&kw=" . $destination;
   header( "Location: {$url}" );
 }

//get-user-infoに書かれている関数を呼び出し
//con_train_info($startPoint, $destination, $year, $month, $day, $hour, $minuteTens, $minuteOnes));
$leaveTime = get_train_time($startPoint, $destination, $year, $month, $day, $hour, $minuteTens, $minuteOnes);
$url =  "http://transit.yahoo.co.jp/search/result?flatlon=&from=" . $startPoint . "&tlatlon=&to=" . $destination . "&via=&via=&via=&y=" . $year . "&m=" . $month . "&d=" . $day . "&hh=" . $hour . "&m1=" . $minuteTens . "&m2=" . $minuteOnes . "&type=4&ticket=ic&al=1&shin=1&ex=1&hb=1&lb=1&sr=1&s=0&expkind=1&ws=2&kw=" . $destination;

if (isset($leaveTime)) {
    $leaveHour = $leaveTime[0];
    $leaveMinute = $leaveTime[1];
    sendOsc("/time", (int)$year, (int)$month, (int)$day, (int)$leaveHour, (int)$leaveMinute);
    //sendOsc("/url", (string)$url);
    sendOsc("/url", "http://transit.yahoo.co.jp/search/result?flatlon=&from=" . $startPoint . "&tlatlon=&to=" . $destination . "&via=&via=&via=&y=" . $year . "&m=" . $month . "&d=" . $day . "&hh=" . $hour . "&m1=" . $minuteTens . "&m2=" . $minuteOnes . "&type=4&ticket=ic&al=1&shin=1&ex=1&hb=1&lb=1&sr=1&s=0&expkind=1&ws=2&kw=" . $destination);
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<title>情報入力フォーム</title>
<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
    </head>
    <body>

    <div class="register">
    <p>電車情報登録</p>
    </div>

    <article>
    <div class="station">
    <div class="station-box">
    <div class="station-form">出発駅</div>
    <form action = "index.php" method = "get">
    <input type = "text" name = "startPoint">
    </div>

    <div class="station-box">
    <div class="station-form">到着駅</div>
    <form action = "index.php" method = "get">
    <input type = "text" name = "destination">
    </div>
    </div>

    <div class="time">
    <div class="time-box">
    <div class="time-form">到着時間</div>
    <form action = "index.php" method = "get">
 
    <select name = "year">
    <option value = "2016">2016</option>
    <option value = "2017">2017</option>
    <option value = "2018">2018</option>
    </select>年
    <br>
    
    <form action = "index.php" method = "get">
    <select name = "month" >
    <option value = "01">1</option>
    <option value = "02">2</option>
    <option value = "03">3</option>
    <option value = "04">4</option>
    <option value = "05">5</option>
    <option value = "06">6</option>
    <option value = "07">7</option>
    <option value = "08">8</option>
    <option value = "09">9</option>
    <option value = "10">10</option>
    <option value = "11">11</option>
    <option value = "12">12</option>
    </select>月

    <form action = "index.php" method = "get">
    <select name = "day">
    <option value = "01">1</option>
    <option value = "02">2</option>
    <option value = "03">3</option>
    <option value = "04">4</option>
    <option value = "05">5</option>
    <option value = "06">6</option>
    <option value = "07">7</option>
    <option value = "08">8</option>
    <option value = "09">9</option>
    <option value = "10">10</option>
    <option value = "11">11</option>
    <option value = "12">12</option>
    <option value = "13">13</option>
    <option value = "14">14</option>
    <option value = "15">15</option>
    <option value = "16">16</option>
    <option value = "17">17</option>
    <option value = "18">18</option>
    <option value = "19">19</option>
    <option value = "20">20</option>
    <option value = "21">21</option>
    <option value = "22">22</option>
    <option value = "23">23</option>
    <option value = "24">24</option>
    <option value = "25">25</option>
    <option value = "26">26</option>
    <option value = "27">27</option>
    <option value = "28">28</option>
    <option value = "29">29</option>
    <option value = "30">30</option>
    <option value = "31">31</option>
    </select>日

    <form action = "index.php" method = "get">
    <select name = "hour">
    <option value = "00">0</option>
    <option value = "01">1</option>
    <option value = "02">2</option>
    <option value = "03">3</option>
    <option value = "04">4</option>
    <option value = "05">5</option>
    <option value = "06">6</option>
    <option value = "07">7</option>
    <option value = "08">8</option>
    <option value = "09">9</option>
    <option value = "10">10</option>
    <option value = "11">11</option>
    <option value = "12">12</option>
    <option value = "13">13</option>
    <option value = "14">14</option>
    <option value = "15">15</option>
    <option value = "16">16</option>
    <option value = "17">17</option>
    <option value = "18">18</option>
    <option value = "19">19</option>
    <option value = "20">20</option>
    <option value = "21">21</option>
    <option value = "22">22</option>
    <option value = "23">23</option>
    </select>時

    <form action = "index.php" method = "get"><select name = "minuteTens"><option value = "0">0</option><option value = "1">1</option><option value = "2">2</option><option value = "3">3</option><option value = "4">4</option><option value = "5">5</option></select><form action = "index.php" method = "get"><select name = "minuteOnes"><option value = "0">0</option><option value = "1">1</option><option value = "2">2</option><option value = "3">3</option><option value = "4">4</option><option value = "5">5</option><option value = "6">6</option><option value = "7">7</option><option value = "8">8</option><option value = "9">9</option></select>分
    </div>
    </div>
    </article>
    <?php
    $url =  "http://transit.yahoo.co.jp/search/result?flatlon=&from=" . $startPoint . "&tlatlon=&to=" . $destination . "&via=&via=&via=&y=" . $year . "&m=" . $month . "&d=" . $day . "&hh=" . $hour . "&m1=" . $minuteTens . "&m2=" . $minuteOnes . "&type=4&ticket=ic&al=1&shin=1&ex=1&hb=1&lb=1&sr=1&s=0&expkind=1&ws=2&kw=" . $destination;
    ?>

    <div class="submit">
    <input type = "submit" value ="送信"><br>
    </div>
    <div class="reset">
    <input type="reset" type = "reset" value="入力内容をリセットする">
    </div>

    </body>
    </html>
