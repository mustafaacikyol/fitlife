<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/trainer/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Generate Nutrition</title>
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
                        if(isset($_POST["generateBtn"])){
                            $generate = $conn->prepare("insert into nutrition set name=:name, target=:target, daily_meal=:daily_meal, calorie_target=:calorie_target");
                            $generate_result = $generate->execute(array("name" => $_POST["name"], "target" => $_POST["target"], "daily_meal" => $_POST["daily_meal"], "calorie_target" => $_POST["calorie_target"]));
                            if (isset($generate_result)) {
                                $get_nutrition_id = $conn->prepare("select id from nutrition order by id desc limit 1");
                                $get_nutrition_id->execute();
                                $nutrition_id_result = $get_nutrition_id->fetch(PDO::FETCH_ASSOC);
                                
                                $add_nutrition = $conn->prepare("insert into trainer_nutrition set trainer_id=:trainer_id, nutrition_id=:nutrition_id");
                                $add_nutrition_result = $add_nutrition->execute(array("nutrition_id" => $nutrition_id_result["id"], "trainer_id" => $_SESSION["id"]));

                                if(isset($add_nutrition_result)){
                                    echo "<div class='alert alert-icon alert-success' role='alert'>
                                    <em class='icon ni ni-check-circle'></em> 
                                    <strong>Nutrition generated successfully</strong> 
                                    </div>";
                                    header("refresh:1;trainer-display-nutrition");
                                }else {
                                    echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                    <em class='icon ni ni-cross-circle'></em> 
                                    <strong>Failed to Generate Nutrition!</strong>
                                    </div>";
                                }

                                
                            } else {
                                echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                <em class='icon ni ni-cross-circle'></em> 
                                <strong>Failed to Generate Nutrition!</strong>
                                </div>";
                            }
                        }
                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $_POST['name'] ?>" required>
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
                                        if ($_POST["expertise"] == $expertise_result["id"]) {
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
                            <input type="text" class="form-control" id="daily_meal" name="daily_meal" value="<?php echo $_POST['daily_meal'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="calorie_target">Calorie Target</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control" id="calorie_target" name="calorie_target" value="<?php echo $_POST['calorie_target'] ?>" required>
                        </div>
                        <div class="form-group mt-5 mb-5">
                            <button type="submit" class="btn btn-md btn-round btn-primary" name="generateBtn">Generate</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include_once("inc/dashboard_js.php") ?>

</body>
</html>