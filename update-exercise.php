<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/trainer/session.php");
    $query = $conn->prepare("select e.id, e.name, e.repetition, e.video, e.start_date, e.duration, exp.profession from exercise as e inner join trainer_exercise as te on e.id=te.exercise_id inner join expertise as exp on e.target=exp.id where e.id=:id");
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
                            $update = $conn->prepare("update exercise as e inner join expertise as exp on e.target=exp.id set e.name=:name, e.target=:target, e.repetition=:repetition, e.video=:video, e.start_date=:start_date, e.duration=:duration where e.id=:id");
                            $update_result = $update->execute(array("id" => $_GET["id"], "name" => $_POST["name"], "target" => $_POST["target"], "repetition" => $_POST["repetition"], "video" => $_POST["video"], "start_date" => $_POST["start_date"], "duration" => $_POST["duration"]));
                            if ($update_result) {
                                echo "<div class='alert alert-icon alert-success' role='alert'>
                                            <em class='icon ni ni-check-circle'></em> 
                                            <strong>Exercise updated.</strong>. 
                                        </div>";
                                header("location:trainer-display-exercise");
                            }else {
                                echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                            <em class='icon ni ni-cross-circle'></em> 
                                            <strong>Exercise cannot be updated!</strong> 
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
                            <label class="form-label" for="repetition">Repetition</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control" id="repetition" name="repetition" value="<?php echo $result['repetition'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="video">Video</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="video" name="video" value='<?php echo $result["video"] ?>' required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="start_date">Start Date</label>
                            <span class="text-danger">*</span>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $result['start_date'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="duration">Duration</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control" id="duration" name="duration" value="<?php echo $result['duration'] ?>" required>
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