<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/client/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Display Progress</title>
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
                            <th colspan="7" class="text-center py-2">PROGRESS RECORDS</th>
                        </tr>
                        <tr>
                            <th class="text-center border">Day</th>
                            <th class="text-center border">Weight</th>
                            <th class="text-center border">Tall</th>
                            <th class="text-center border">Body Mass Index</th>
                            <th class="text-center border">Muscle Mass</th>
                            <th class="text-center border">Body Fat Ratio</th>
                            <th class="text-center border">Update</th>
                        </tr>
                        <?php
                            $counter = 1;
                            $exercise_info = $conn->prepare("select p.id, p.weight, p.tall, p.body_mass_index, p.muscle_mass, p.body_fat_ratio from progress as p inner join client_progress as cp on p.id=cp.progress_id where cp.client_id=:client_id order by p.id");
                            $exercise_info->execute(array("client_id"=>$_SESSION["client_id"]));
                            while ($results = $exercise_info->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td class="text-center border"><?php echo $counter ; ?></td>
                                <td class="text-center border"><?php echo $results["weight"] ; ?></td>
                                <td class="text-center border"><?php echo $results["tall"]; ?></td>
                                <td class="text-center border"><?php echo $results["body_mass_index"]; ?></td>
                                <td class="text-center border"><?php echo $results["muscle_mass"]; ?></td>
                                <td class="text-center border"><?php echo $results["body_fat_ratio"]; ?></td>
                                <td class="border text-center">
                                        <a href="update-progress?id=<?php echo $results['id']; ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
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