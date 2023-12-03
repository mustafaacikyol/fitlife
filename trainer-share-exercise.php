<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/trainer/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Share Exercise</title>
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
                        if(isset($_POST["shareBtn"])){
                            $generate = $conn->prepare("insert into client_exercise set client_id=:client_id, exercise_id=:exercise_id");
                            $generate_result = $generate->execute(array("client_id" => $_POST["id"], "exercise_id" => $_GET["id"]));
                            if (isset($generate_result)) {
                                echo "<div class='alert alert-icon alert-success' role='alert'>
                                    <em class='icon ni ni-check-circle'></em> 
                                    <strong>Exercise shared successfully</strong> 
                                    </div>";
                                    header("refresh:1;trainer-display-exercise");
                            }else {
                                echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                <em class='icon ni ni-cross-circle'></em> 
                                <strong>Failed to Share Exercise!</strong>
                                </div>";
                            }
                        }
                                
                    ?>
                    <form action="" method="post">
                        <div class="mb-5">
                            <p>Please enter the client number you would like to share</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="id">Client No</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $_POST['id'] ?>" required>
                        </div>
                        <div class="form-group mt-5 mb-5">
                            <button type="submit" class="btn btn-md btn-round btn-primary" name="shareBtn">Share</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include_once("inc/dashboard_js.php") ?>

</body>
</html>