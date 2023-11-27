<?php 
include_once("db_connect.php");

//Oturum kapat butonuna basınca kullanıcı oturumu kapansın
if ($_GET["user"]=="logout") {
    unset($_SESSION["admin"]);
    unset($_SESSION["id"]);
    header("location:index");
}

//Oturum açık değilse giris.php sayfasına gönder

if ($_SESSION["admin"] == "" and $_SESSION["id"] == "") {
    header("location:index");
}
?>