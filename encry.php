<?php

/**
 * @package local_qrbasedimage
 * @author Pearl Miglani <miglanipearl@gmail.com> and Shreyans Jain <shreyansja1n@outlook.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '9182736454261527'; 
$encryption_key = "N11TU17!V3R&I";