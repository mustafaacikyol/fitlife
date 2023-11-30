<?php 
    include_once("inc/db_connect.php");
    include_once("inc/client/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Client Dashboard</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <?php include_once("inc/client/header.php") ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("inc/client/sidebar.php") ?>

            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="content">
                    <!-- Add your content here -->
                    <h2>Client Dashboard</h2>
                    <p>Welcome to the client dashboard! Customize and add your content here.</p>
                </div>
            </main>
        </div>
    </div>

    <?php include_once("inc/dashboard_js.php") ?>

</body>
</html>