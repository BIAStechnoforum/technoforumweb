<?php
if (isset($_POST['name'])) {
    $font="BRUSHSCI.TTF";
    $image=imagecreatefromjpeg("certificate.jpg");
    $color=imagecolorallocate($image, 19, 21, 22);
    $name="Vishal Gupta";
    imagettftext($image, 50, 0, 365, 420, $color, $font, $_POST['name']);
    $date="6th may 2020";
    imagettftext($image, 20, 0, 450, 595, $color, "AGENCYR.TTF", $date);
    $file=time();
    imagejpeg($image, "certificate/".$file.".jpg");
    imagedestroy($image);
}
?>
<form method="post">
	<input type="textbox" name="name"/>
	<input type="submit"/>
</form>
