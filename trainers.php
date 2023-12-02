<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/admin/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Trainers</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <?php include_once("inc/admin/header.php") ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("inc/admin/sidebar.php") ?>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="content">
                    
                    
                        <table class="border" style="width: 100%;">
                            <tr class="border">
                                <th colspan="11" class="text-center py-2">TRAINERS</th>
                            </tr>
                            <tr>
                                <th class="text-center border">Order</th>
                                <th class="text-center border">Name</th>
                                <th class="text-center border">Surname</th>
                                <th class="text-center border">Expertise</th>
                                <th class="text-center border">Birthdate</th>
                                <th class="text-center border">Gender</th>
                                <th class="text-center border">Email</th>
                                <th class="text-center border">Phone</th>
                                <th class="text-center border">State</th>
                                <th class="text-center border">Update</th>
                                <th class="text-center border">Delete</th>
                            </tr>
                            <?php
                                $update = $conn -> prepare("update trainer set state=:state where id=:id");
                                $update -> execute (array("state" => $_GET["state"], "id" => $_GET["id"]));
                                $delete_trainer_expertise =  $conn ->  prepare("delete from trainer_expertise where trainer_id=:trainer_id");
                                $delete_trainer_expertise -> execute (array("trainer_id" => $_GET["del_id"]));
                                $delete =  $conn ->  prepare("delete from trainer where id=:id");
                                $delete -> execute (array("id" => $_GET["del_id"]));
                                $counter  =   1;
                                $trainer_info       =   $conn->prepare("select t.id, t.name, t.surname, t.birthdate, t.gender, t.email, t.phone_number, t.state, e.profession from trainer as t inner join trainer_expertise as te on t.id=te.trainer_id inner join expertise as e on te.expertise_id=e.id order by t.id");
                                $trainer_info->execute();
                                while ($results    =   $trainer_info->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td class="text-center border"><?php echo $counter ; ?></td>
                                    <td class="text-center border"><?php echo $results["name"] ; ?></td>
                                    <td class="text-center border"><?php echo $results["surname"]; ?></td>
                                    <td class="text-center border"><?php echo $results["profession"]; ?></td>
                                    <td class="text-center border"><?php echo $results["birthdate"]; ?></td>
                                    <td class="text-center border"><?php echo $results["gender"]; ?></td>
                                    <td class="text-center border"><?php echo $results["email"]; ?></td>
                                    <td class="text-center border"><?php echo $results["phone_number"]; ?></td>
                                    <td class="text-center border">
                                        <?php
                                            $state = $results["state"];
                                            $id = $results["id"];
                                            if ($state == 1) {
                                                echo "<a href='trainers?state=0&id=$id'><i class='far fa-check-circle text-success'></i></a>";
                                            } else {
                                                echo "<a href='trainers?state=1&id=$id'><i class='far fa-times-circle text-danger'></i></a>";
                                            }  
                                        ?>
                                    </td>
                                    <td class="border text-center">
                                        <a href="update-trainer?id=<?php echo $results['id']; ?>">
                                            <i class="fas fa-user-edit"></i>
                                        </a>
                                    </td>
                                    <td class="border text-center">
                                        <a href="trainers/?del_id=<?php echo $results['id']; ?>" onclick="return confirm('The trainer you selected will be deleted. Are you sure?')" title="<?php echo $results['name'] . ' ' . $results['surname']; ?> will be deleted">
                                            <i class="fas fa-trash text-dark"></i>
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