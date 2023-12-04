<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/trainer/session.php");
    $query = $conn->prepare("select n.id, n.name, n.daily_meal, n.calorie_target, exp.profession from nutrition as n inner join trainer_nutrition as tn on n.id=tn.nutrition_id inner join expertise as exp on n.target=exp.id where n.id=:id");
    $query->execute(array("id" => $_GET["id"]));
    $result = $query->fetch(PDO::FETCH_ASSOC);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Update Exercise</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <?php include_once("inc/trainer/header.php") ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("inc/trainer/sidebar.php") ?>
           
            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="content col-6 text-center" style="margin-left: 250px;">
                    <?php
                        if (isset($_POST["updateBtn"])) {
                            $update = $conn->prepare("update nutrition as n inner join expertise as exp on n.target=exp.id set n.name=:name, n.target=:target, n.daily_meal=:daily_meal, n.calorie_target=:calorie_target where n.id=:id");
                            $update_result = $update->execute(array("id" => $_GET["id"], "name" => $_POST["name"], "target" => $_POST["target"], "daily_meal" => $_POST["daily_meal"], "calorie_target" => $_POST["calorie_target"]));
                            if ($update_result) {
                                echo "<div class='alert alert-icon alert-success' role='alert'>
                                            <em class='icon ni ni-check-circle'></em> 
                                            <strong>Nutrition updated.</strong>. 
                                        </div>";
                                header("location:trainer-display-nutrition");
                            }else {
                                echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                            <em class='icon ni ni-cross-circle'></em> 
                                            <strong>Nutrition cannot be updated!</strong> 
                                        </div>";
                            }
                        }

                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $result['name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="target">Target</label>
                            <span class="text-danger">*</span>
                            <select id="target" name="target" class="form-control" required>
                                <option value="">Select Target</option>
                                <?php
                                    $expertise = $conn -> prepare("select * from expertise order by id asc");
                                    $expertise -> execute();

                                    while ($expertise_result = $expertise->fetch(PDO::FETCH_ASSOC)) {

                                        $id = $expertise_result["id"];
                                        $name = $expertise_result["profession"];
                                        if ($result["profession"] == $expertise_result["profession"]) {
                                            $select = 'selected=""';
                                        } else {
                                            $select  = '';
                                        }

                                        echo "<option value='$id' $select>$name</option>";
                                    }

                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="daily_meal">Daily Meal</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="daily_meal" name="daily_meal" value="<?php echo $result['daily_meal'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="calorie_target">Calorie Target</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control" id="calorie_target" name="calorie_target" value='<?php echo $result["calorie_target"] ?>' required>
                        </div>
                        <div class="form-group mt-3 mb-4">
                            <button type="submit" class="btn btn-md btn-round btn-primary" name="updateBtn">Update</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include_once("inc/dashboard_js.php") ?>

</body>
</html>