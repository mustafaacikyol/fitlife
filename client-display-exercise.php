<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/client/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Client Display Exercise</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <?php include_once("inc/client/header.php") ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("inc/client/sidebar.php") ?>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="content">
                    <table class="border" style="width: 100%;">
                        <tr class="border">
                            <th colspan="7" class="text-center py-2">EXERCISES</th>
                        </tr>
                        <tr>
                            <th class="text-center border">Order</th>
                            <th class="text-center border">Name</th>
                            <th class="text-center border">Target</th>
                            <th class="text-center border">Repetition</th>
                            <th class="text-center border">Video</th>
                            <th class="text-center border">Start Date</th>
                            <th class="text-center border">Duration</th>
                        </tr>
                        <?php
                            $counter = 1;
                            $exercise_info = $conn->prepare("select e.id, e.name, e.repetition, e.video, e.start_date, e.duration, exp.profession from exercise as e inner join client_exercise as ce on e.id=ce.exercise_id inner join expertise as exp on e.target=exp.id where ce.client_id=:client_id order by e.id");
                            $exercise_info->execute(array("client_id"=>$_SESSION["client_id"]));
                            while ($results = $exercise_info->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td class="text-center border"><?php echo $counter ; ?></td>
                                <td class="text-center border"><?php echo $results["name"] ; ?></td>
                                <td class="text-center border"><?php echo $results["profession"]; ?></td>
                                <td class="text-center border"><?php echo $results["repetition"]; ?></td>
                                <td class="text-center border"><?php echo $results["video"]; ?></td>
                                <td class="text-center border"><?php echo $results["start_date"]; ?></td>
                                <td class="text-center border"><?php echo $results["duration"]; ?></td>
                            </tr>
                        <?php $counter++;
                        }
                        ?>
                        
                    </table>
                </div>
            </main>
        </div>
    </div>

    <?php include_once("inc/dashboard_js.php") ?>

</body>
</html>