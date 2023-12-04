<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/trainer/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Display Clients</title>
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
                            <th colspan="11" class="text-center py-2">CLIENTS</th>
                        </tr>
                        <tr>
                            <th class="text-center border">Order</th>
                            <th class="text-center border">No</th>
                            <th class="text-center border">Name</th>
                            <th class="text-center border">Surname</th>
                            <th class="text-center border">Target</th>
                            <th class="text-center border">Birthdate</th>
                            <th class="text-center border">Gender</th>
                            <th class="text-center border">Email</th>
                            <th class="text-center border">Phone</th>
                            <th class="text-center border">Message</th>
                            <th class="text-center border">Progress</th>
                        </tr>
                        <?php
                            $counter = 1;
                            $client_info = $conn->prepare("select c.id, c.name, c.surname, c.birthdate, c.gender, c.email, c.phone_number, e.profession from client as c inner join client_target as ct on c.id=ct.client_id inner join expertise as e on ct.target_id=e.id inner join match_clients as mc on c.id=mc.client_id where mc.trainer_id=:trainer_id and c.state=1 order by c.id");
                            $client_info->execute(array("trainer_id"=>$_SESSION["id"]));
                            while ($results = $client_info->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td class="text-center border"><?php echo $counter ; ?></td>
                                <td class="text-center border"><?php echo $results["id"] ; ?></td>
                                <td class="text-center border"><?php echo $results["name"] ; ?></td>
                                <td class="text-center border"><?php echo $results["surname"]; ?></td>
                                <td class="text-center border"><?php echo $results["profession"]; ?></td>
                                <td class="text-center border"><?php echo $results["birthdate"]; ?></td>
                                <td class="text-center border"><?php echo $results["gender"]; ?></td>
                                <td class="text-center border"><?php echo $results["email"]; ?></td>
                                <td class="text-center border"><?php echo $results["phone_number"]; ?></td>
                                <td class="border text-center">
                                    <a href="trainer-write-message?id=<?php echo $results['id']; ?>">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </td>
                                <td class="border text-center">
                                    <a href="trainer-display-progress?id=<?php echo $results['id']; ?>">
                                        <i class="fas fa-eye"></i>
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