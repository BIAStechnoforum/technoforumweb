<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/config.php';
$post = $_POST;
$json = array();
$json['post'] = $post;

if (!empty($post['action']) && $post['action']=="generateCertificate") {
    $name = $post['awardedTo'];
    $position = $post['position'];
    $competitionName = $post['competitionName'];
    $competitionDate = date('d-M-Y', strtotime($post['competitionDate']));
    $certificateId = $post['certificateId'];
    $imageName = time() . '.jpg';
    $created_at = time();

    $sql = "INSERT INTO certificates (certificate_id, image, awarded_to, comp_name, comp_date, position, created_at) VALUES ('$certificateId', '$imageName', '$name', '$competitionName', '$competitionDate', '$position', '$created_at')";
    $res = mysqli_query($link, $sql);

    if ($res) {
        $nameFont="./Anton-Regular.ttf";
        $textFont="./OpenSans-Regular.ttf";
        $font_size = 100;
        $image=imagecreatefromjpeg("certificate.jpg");
        $textColor=imagecolorallocate($image, 19, 21, 22);
        $nameColor=imagecolorallocate($image, 40, 57, 101);
        $certificateIdColor=imagecolorallocate($image, 255, 255, 255);

        // Get image Width and Height
        $image_width = imagesx($image);
        $image_height = imagesy($image);

        // Get Bounding Box Size
        $name_box = imagettfbbox(250, 0, $nameFont, strtoupper($name));

        // Get your Text Width and Height
        $name_width = $name_box[2]-$name_box[0];
        $name_height = $name_box[7]-$name_box[1];

        // Calculate coordinates of the text
        $x = ($image_width/2) - ($name_width/2);
        $y = ($image_height/2) - ($name_height/2);

        imagettftext($image, 250, 0, $x, $y-10, $nameColor, $nameFont, strtoupper($name));





        $text= 'For achieving ' . $position . ' position in the event ' . $competitionName;

        $text_box = imagettfbbox(50, 0, $textFont, $text);

        // Get your Text Width and Height
        $text_width = $text_box[2]-$text_box[0];
        $text_height = $text_box[7]-$text_box[1];

        // Calculate coordinates of the text
        $x = ($image_width/2) - ($text_width/2);
        $y = ($image_height/2) - ($text_height/2);



        imagettftextSp($image, 50, 0, $x, $y+250, $textColor, $textFont, $text, 30);

        $nextLine = 'conducted on ' . $competitionDate . '.';

        $newLine_box = imagettfbbox(50, 0, $textFont, $nextLine);

        // Get your Text Width and Height
        $newLine_width = $newLine_box[2]-$newLine_box[0];
        $newLine_height = $newLine_box[7]-$newLine_box[1];

        // Calculate coordinates of the text
        $x = ($image_width/2) - ($newLine_width/2);
        $y = ($image_height/2) - ($newLine_height/2);






        imagettftextSp($image, 50, 0, $x, $y+350, $textColor, $textFont, $nextLine, 30);

        imagettftext($image, 43, 0, $x+1370, $y+1150, $certificateIdColor, $textFont, 'Certificate No: ' . $certificateId);

        // imagejpeg($image, "certificate/".$file.".jpg");
        imagejpeg($image, '../certificates/' . $imageName);
        imagedestroy($image);

        $json['image'] = $imageName;
        $json['status'] = 'success';
    } else {
      $json['status'] = 'failed';
    }

    $json['link'] = $link;

    header('Content-Type: application/json');
    echo json_encode($json);
}

function imagettftextSp($image, $size, $angle, $x, $y, $color, $font, $text, $spacing = 0)
{
    if ($spacing == 0) {
        imagettftext($image, $size, $angle, $x, $y, $color, $font, $text);
    } else {
        $textArr = explode(' ', $text);
        $temp_x = $x;
        for ($i = 0; $i < count($textArr); $i++) {
            $bbox = imagettftext($image, $size, $angle, $temp_x, $y, $color, $font, $textArr[$i]);
            $temp_x += $spacing + ($bbox[2] - $bbox[0]);
        }
    }
}
