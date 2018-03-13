<?php
/*
 * This is File for Configuration
 */

// Starting Session
session_start();

// Name Site
define("_TITLE","cURL");

define("_SLUG","Penyingkat URL dari indonesia");

// Description Site
define("_DESCRIPTION","Sebuah alat yang bisa memperpendek url anda, dari yang panjang menjadi beberapa kata acak saja dan hasilnya bisa di costum. Semuanya gratis.");

// Url site ( With / )
define("_URL","http://localhost/shorturl/");

// How Long Short
define("_LONG","8");

// Login to Admin Panel
define("_ADMINUSERNAME","rudi");
define("_ADMINPASSWORD","ami");

// Connection to Database
define("_SERVER","localhost");
define("_USERNAME","root");
define("_PASSWORD","");
define("_DBNAME","shorturl");
$conn = new mysqli(_SERVER,_USERNAME,_PASSWORD,_DBNAME);

// check connection to database success or not.
if ($conn->connect_error) {
    die("Ups Sorry, Connection failed : " . $conn->connect_error);
}