<?php 

/**
 * @package local_qrbasedimage
 * @author Pearl Miglani <miglanipearl@gmail.com> and Shreyans Jain <shreyansja1n@outlook.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__.'/../../config.php');
include 'url.php';
global $DB;
$aid = $_POST['aid'];
require_once('encry.php');
$decryption = openssl_decrypt($aid, $ciphering,$encryption_key, $options, $encryption_iv);
$dec = explode('-',$decryption);

$aid=$dec[0];
$slot=$dec[1];
$qid=$dec[2];
$images =$DB->get_records('images', ['attemptid'=>$aid, 'quesid'=>$qid, 'slot'=>$slot],'','*');
$x=0;
if ($images){
    foreach ($images as $img){
        echo "<div id='image$x' >
        <img src=$url{$img->image} id='img$x' style='height:200px;padding-right:10px;padding-top:10px'></img>
        <button class='btn btn-danger' onclick='deleteimage$x()' >Delete</button>
        </div>";

        echo "<script>
        function deleteimage$x(){
          if(confirm('Are you sure?')){
            $('#image$x').remove();
            $.post('$url/local/qrbasedimage/deleteimage.php',{id:'$img->image'});

          }
          else{

          }
        }
        </script>";
        $x++;
    }
}
else{
    echo "No Images to display";
}


?>