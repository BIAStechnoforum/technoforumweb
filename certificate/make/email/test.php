<?php
/*require('fpdf.php');
$pdf=new FPDF();
$pdf->AddPage();
$pdf->Image("certificate.jpg",0,0,210,150);
$pdf->Output("test.pdf","F");*/

include('smtp/PHPMailerAutoload.php');
$mail=new PHPMailer();
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->SMTPSecure="tls";
$mail->SMTPAuth=true;
$mail->Username="ytlearnwebdevelopment@gmail.com";
$mail->Password="vishal@21";
$mail->setFrom("ytlearnwebdevelopment@gmail.com");
$mail->addAddress("ytlearnwebdevelopment@gmail.com");
$mail->isHTML(true);
$mail->Subjet="Certificate Generated";
$mail->Body="Certificate Generated";
$mail->addAttachment("certificate/1588786846.pdf");
$mail->SMTPOptions=array("ssl"=>array(
    "verify_peer"=>false,
    "verify_peer_name"=>false,
    "allow_self_signed"=>false,
));
if($mail->send()){
    echo "Send";
}else{
    echo $mail->ErrorInfo;
}
?>