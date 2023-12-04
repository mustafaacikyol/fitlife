<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/trainer/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Generate Exercise</title>
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
                            $generate = $conn->prepare("insert into exercise set name=:name, target=:target, repetition=:repetition, video=:video, start_date=:start_date, duration=:duration");
                            $generate_result = $generate->execute(array("name" => $_POST["name"], "target" => $_POST["target"], "repetition" => $_POST["repetition"], "video" => $_POST["video"], "start_date" => $_POST["start_date"], "duration" => $_POST["duration"]));
                            if (isset($generate_result)) {
                                $get_exercise_id = $conn->prepare("select id from exercise order by id desc limit 1");
                                $get_exercise_id->execute();
                                $exercise_id_result = $get_exercise_id->fetch(PDO::FETCH_ASSOC);
                                
                                $add_exercise = $conn->prepare("insert into trainer_exercise set trainer_id=:trainer_id, exercise_id=:exercise_id");
                                $add_exercise_result = $add_exercise->execute(array("exercise_id" => $exercise_id_result["id"], "trainer_id" => $_SESSION["id"]));

                                if(isset($add_exercise_result)){
                                    echo "<div class='alert alert-icon alert-success' role='alert'>
                                    <em class='icon ni ni-check-circle'></em> 
                                    <strong>Exercise generated successfully</strong> 
                                    </div>";
                                    header("refresh:1;trainer-display-exercise");
                                }else {
                                    echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                    <em class='icon ni ni-cross-circle'></em> 
                                    <strong>Failed to Generate Exercise!</strong>
                                    </div>";
                                }

                                
                            } else {
                                echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                <em class='icon ni ni-cross-circle'></em> 
                                <strong>Failed to Generate Exercise!</strong>
                                </div>";
                            }
                        }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
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
                            <label class="form-label" for="repetition">Repetition</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control" id="repetition" name="repetition" value="<?php echo $_POST['repetition'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="video">Video</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="video" name="video" value="<?php echo $_POST['video'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="start_date">Start Date</label>
                            <span class="text-danger">*</span>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $_POST['start_date'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="duration">Duration</label>
                            <input type="number" class="form-control" name="duration" id="duration">
                        </div>
                        <div class="form-group mt-3 mb-5">
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