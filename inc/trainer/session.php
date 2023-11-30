<?php 
    // include_once("../db_connect.php");

    //Oturum açık değilse giris.php sayfasına gönder

    if ($_SESSION["trainer"] == "") {
        header("location:trainer-login");
    }

    //Oturum kapat butonuna basınca kullanıcı oturumu kapansın

    if ($_GET["user"]=="logout") {
        unset($_SESSION["trainer"]);
        unset($_SESSION["id"]);
        header("location:index");
    } 

?>