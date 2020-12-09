<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/config.php';
$post = $_POST;
$json = array();
$json['post'] = $post;

if (!empty($post['action']) && $post['action']=="generateCertificate") {
    $font="BRUSHSCI.TTF";
    $image=imagecreatefromjpeg("../certificate.jpg");
    $color=imagecolorallocate($image, 19, 21, 22);
    $name = $post['awardedTo'];
    imagettftext($image, 50, 0, 365, 420, $color, $font, $_POST['name']);
    $date = $post['competitionDate'];
    imagettftext($image, 20, 0, 450, 595, $color, "AGENCYR.TTF", $date);
    $file=time();
    imagejpeg($image, "../".$file.".jpg");
    imagedestroy($image);

    header('Content-Type: application/json');
    echo json_encode($json);
}
