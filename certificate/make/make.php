<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/config.php';
$post = $_POST;
$json = array();
$json['post'] = $post;

$senderEmailId = 'techno_forum@birlainstitute.co.in';
$senderEmailPass = '7Z57wy2xn)5z';

if (!empty($post['action']) && $post['action']=="generateCertificate") {
    $name = $post['awardedTo'];
    $position = $post['position'];
    $competitionName = $post['competitionName'];
    $competitionDate = date('d-M-Y', strtotime($post['competitionDate']));
    $certificateId = $post['certificateId'];
    $studentEmailId = $post['email'];
    $imageName = $certificateId . '.jpg';
    $created_at = time();

    $sql = "INSERT INTO certificates (certificate_id, image, awarded_to, comp_name, comp_date, position, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssssss", $certificateId, $imageName, $name, $competitionName, $competitionDate, $position, $created_at);

        // Attempt to execute the prepared statement
        if ($res = mysqli_stmt_execute($stmt)) {
            // Store result
            mysqli_stmt_store_result($stmt);
        } else {
            $json['msg'] =  "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

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

        $file_path = '../certificates/' . str_replace('jpg', 'pdf', $imageName);
        $file_path_pdf = '../pdfs/' . str_replace('jpg', 'pdf', $imageName);

        // GENERATE PDF
        require('fpdf.php');
        $pdf=new FPDF();
        $pdf->AddPage();
        $pdf->Image($file_path, 0, 0, 210, 150);
        $pdf->Output($file_path_pdf, "F");

        include('smtp/PHPMailerAutoload.php');
        $mail=new PHPMailer();
        $mail->isSMTP();
        $mail->Host='mail.birlainstitute.co.in';
        $mail->Port=465;
        $mail->SMTPSecure="tls";
        $mail->SMTPAuth=true;
        $mail->Username=$senderEmailId;
        $mail->Password=$senderEmailPass;
        $mail->setFrom($senderEmailId);
        $mail->addAddress($studentEmailId);
        $mail->isHTML(true);
        $mail->Subjet="Certificate Generated";
        $mail->Body="Certificate Generated";
        $mail->addAttachment($file_path_pdf);
        $mail->SMTPOptions=array("ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
            "allow_self_signed"=>false,
        ));
        if ($mail->send()) {
            $json['mail-status'] = "Sent!";
        } else {
            $json['mail-status'] = $mail->ErrorInfo;
        }
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
