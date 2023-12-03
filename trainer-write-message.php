<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/trainer/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Trainer Write Message</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <?php include_once("inc/trainer/header.php") ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("inc/trainer/sidebar.php") ?>
           
            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="content col-4 text-center" style="margin-left: 350px;">
                    <?php
                        if(isset($_POST["sendBtn"])){
                            
                            $add_message = $conn->prepare("insert into message set trainer_id=:trainer_id, client_id=:client_id, direction=:direction, content=:content");
                            $add_message_result = $add_message->execute(array("trainer_id" => $_SESSION["id"], "client_id" => $_GET["id"], "direction"=>1, "content"=>$_POST["message"]));
                            
                            if(isset($add_message_result)){
                                echo "<div class='alert alert-icon alert-success' role='alert'>
                                <em class='icon ni ni-check-circle'></em> 
                                <strong>Message Sent</strong> 
                                </div>";
                                header("refresh:1;trainer-send-message");
                            }else {
                                echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                <em class='icon ni ni-cross-circle'></em> 
                                <strong>Failed to send message!</strong>
                                </div>";
                            }  
                        }
                    ?>
                    <form action="" method="post">
                        <div class="form-group mb-5">
                            <label class="form-label" for="message">Message</label>
                            <span class="text-danger">*</span>
                            <textarea id="message" name="message" class="form-control" rows="10" cols="70" required></textarea>
                        </div>
                        <div class="form-group mt-3 mb-5">
                            <button type="submit" class="btn btn-md btn-round btn-primary" name="sendBtn">Send Message</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include_once("inc/dashboard_js.php") ?>

</body>
</html>