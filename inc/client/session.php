<?php 
    // include_once("../db_connect.php");

    //Oturum açık değilse giris.php sayfasına gönder

    if ($_SESSION["client"] == "") {
        header("location:client-login");
    }

    //Oturum kapat butonuna basınca kullanıcı oturumu kapansın

    if ($_GET["user"]=="logout") {
        unset($_SESSION["client"]);
        unset($_SESSION["client_id"]);
        header("location:index");
    } 

?>