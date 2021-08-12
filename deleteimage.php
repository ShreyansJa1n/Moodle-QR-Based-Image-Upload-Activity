<?php 

/**
 * @package local_qrbasedimage
 * @author Pearl Miglani <miglanipearl@gmail.com> and Shreyans Jain <shreyansja1n@outlook.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__.'/../../config.php');
include 'url.php';
global $DB;
$id = $_POST['id'];
$DB->delete_records('images',["image"=>$id]);

?>