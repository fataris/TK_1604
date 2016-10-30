<?php

include 'PhpOSC/OSCClient.php';
include 'PhpOSC/OSCMessage.php';
include 'PhpOSC/Timetag.php';
include 'PhpOSC/Infinitum.php';
include 'PhpOSC/Blob.php';
include 'PhpOSC/OSCBundle.php';

function sendOsc($adr, ...$args) {
$sender = new OSCClient();
$sender->set_destination("224.0.0.1", 54321);
$msg = new OSCMessage($adr);
foreach($args as $n) {
	      $msg->add_arg($n);
	      }
$sender->send($msg);
}

