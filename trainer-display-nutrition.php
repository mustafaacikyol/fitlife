<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/trainer/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Display Nutrition</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <?php include_once("inc/trainer/header.php") ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("inc/trainer/sidebar.php") ?>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="content">
                    <table class="border" style="width: 100%;">
                        <tr class="border">
                            <th colspan="7" class="text-center py-2">NUTRITIONS</th>
                        </tr>
                        <tr>
                            <th class="text-center border">Order</th>
                            <th class="text-center border">Name</th>
                            <th class="text-center border">Target</th>
                            <th class="text-center border">Daily Meal</th>
                            <th class="text-center border">Calorie Target</th>
                            <th class="text-center border">Update</th>
                            <th class="text-center border">Share</th>
                        </tr>
                        <?php
                            $counter = 1;
                            $exercise_info = $conn->prepare("select n.id, n.name, n.daily_meal, n.calorie_target, exp.profession from nutrition as n inner join trainer_nutrition as tn on n.id=tn.nutrition_id inner join expertise as exp on n.target=exp.id where tn.trainer_id=:trainer_id order by n.id");
                            $exercise_info->execute(array("trainer_id"=>$_SESSION["id"]));
                            while ($results = $exercise_info->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td class="text-center border"><?php echo $counter ; ?></td>
                                <td class="text-center border"><?php echo $results["name"] ; ?></td>
                                <td class="text-center border"><?php echo $results["profession"]; ?></td>
                                <td class="text-center border"><?php echo $results["daily_meal"]; ?></td>
                                <td class="text-center border"><?php echo $results["calorie_target"]; ?></td>
                                <td class="border text-center">
                                        <a href="update-nutrition?id=<?php echo $results['id']; ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                <td class="border text-center">
                                    <a href="trainer-share-nutrition?id=<?php echo $results['id']; ?>">
                                        <i class="fas fa-share"></i>
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