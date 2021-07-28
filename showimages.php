<?php 
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
$images = $DB->get_records_sql("SELECT * FROM mdl_images WHERE attemptid=$aid and quesid=$qid and slot=$slot");
$x=0;
if ($images){
    foreach ($images as $img){
        echo '<script>
        var modal = document.getElementById("myModal");
        var img = document.getElementById("'."img$x".'");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
          modal.style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = "'."Image $x".'";
        }
        
        var span = document.getElementsByClassName("close")[0];
        
        span.onclick = function() { 
          modal.style.display = "none";
        }
        </script>';

        echo "<div id='image$x' >
        <img src=$url/{$img->image} id='img$x' style='height:200px;padding-right:10px;padding-top:10px'></img>
        <button class='btn btn-danger' onclick='deleteimage$x()' >Delete</button>
        </div>";

        echo "<script>
        function deleteimage$x(){
          if(confirm('Are you sure?')){
            $('#image$x').remove();
            $.post('$url/mod/quiz/deleteimage.php',{id:'$img->image'});

          }
          else{

          }
        }
        </script>";
        $x++;
    }
}
else{
    echo"No Images to display";
}


?>