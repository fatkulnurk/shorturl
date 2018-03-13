<?php
include "phpqrcode/qrlib.php";

$backColor = 0xFFFFFF;
$foreColor = 0xFFFAFA;
if(isset($_GET['url'])){
    $url = $_GET['url'];
    QRcode::png($url,false,"H",5,1,$backColor,$foreColor);

}
// create a QR Code with this text and display it
//QRcode::png("My First QR Code");

//QRcode::png("My First QR Code",false,"H",5,1,$backColor,$foreColor);

//QRcode::png("http://www.sitepoint.com", "test.png", "L", 4, 4);
//QRcode::png("http://www.sitepoint.com", "test.png", "L", 4, 4,false, $backColor,$foreColor);


// costum


// Create a QR Code and export to SVG
//QRcode::png("http://www.sitepoint.com", "result.png", "L", 4, 4, false, $backColor, $foreColor);
//echo '<img src="result.svg"/>';