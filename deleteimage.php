<?php 
require_once(__DIR__.'/../../config.php');
include 'url.php';
global $DB;
$id = $_POST['id'];
$DB->delete_records('images',["image"=>$id]);

?>