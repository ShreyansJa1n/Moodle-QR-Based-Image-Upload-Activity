<?php

/**
 * @package local_qrbasedimage
 * @author Pearl Miglani <miglanipearl@gmail.com> and Shreyans Jain <shreyansja1n@outlook.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__.'/../../config.php');
global $DB;
$hased=$_POST['id'];
$decryption=base64_decode($hased);
$dec = explode('-', $decryption);  
$uid = $dec[0];
$aid = $dec[1];
$qid = $dec[2];
$sid = $dec[3];
$uniqueid = $dec[4];
$tstamp = $DB->get_field('randomnumber','tstamp',['attemptid'=>$aid, 'ran_num'=>$uid]);
$ctime = date("Y-m-d H:i:s", time());
$diff = strtotime($ctime)-strtotime($tstamp);

require_once('timeQR.php');
if ($diff>$time4qr){
    echo "QR Code has expired!";
    echo ($diff);
}
else{
    $fi = $_POST['files'];
    for($x=0 ; $x<count($fi);$x++){
        $fpath = md5("$uid-$aid-$sid-$x".uniqid()).".jpg";
        $decoded = base64_decode($fi[$x]['Content']);
        $image = imagecreatefromstring($decoded);
        // $rotate_image = imagerotate($image, 270, 0);
        imagejpeg($image, __DIR__.'/uploads/'.$fpath, 70);
        $DB->insert_record("images", ["name"=>$fpath, "image"=>"/local/qrbasedimage/uploads/".$fpath,"ran_num"=>$uid,"attemptid"=>$aid,"quesid"=>$qid,"slot"=>$sid,"uniqueid"=>$uniqueid]);

    }
    echo count($fi)." File(s) uploaded successfully";
}
?>
