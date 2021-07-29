<?php
require_once(__DIR__."/../../config.php"); 
global $DB;
include 'url.php';
$est=$_POST['as'];
require_once('encry.php');
$decryption = openssl_decrypt($est, $ciphering,$encryption_key, $options, $encryption_iv);
$dec = explode('-',$decryption);

$attemptid=$dec[0];
$slotid=$dec[1];
$quesid=$dec[2];
$uniqueid=$dec[3];
$num_str = sprintf("%06d", mt_rand(1, 999999));
$DB->insert_record("randomnumber", ["ran_num"=>$num_str,"attemptid"=>$attemptid]);
$encryption = base64_encode($num_str.'-'.$attemptid.'-'.$quesid.'-'.$slotid.'-'.$uniqueid);
echo "<img class='center' src ='https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=$url/mod/quiz/upload1.php?id={$encryption}'>";

require_once('timeQR.php');

echo

'<p class=center id="demo"></p>

<script>

var countDownDate = new Date().getTime()+'.$time4qr.'*1000;

// Update the count down every 1 second
var x = setInterval(function() {


var now = new Date().getTime();

// Find the distance between now and the count down date
var distance = countDownDate - now;

// Time calculations for days, hours, minutes and seconds
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);

// Display the result in the element with id="demo"
document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";

// If the count down is finished, write some text 
if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
}
}, 1000);
</script>';


?>