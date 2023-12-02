<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/client/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Display Trainer</title>
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
                            <th colspan="8" class="text-center py-2">TRAINER INFORMATION</th>
                        </tr>
                        <tr>
                            <th class="text-center border">Name</th>
                            <th class="text-center border">Surname</th>
                            <th class="text-center border">Target</th>
                            <th class="text-center border">Birthdate</th>
                            <th class="text-center border">Gender</th>
                            <th class="text-center border">Email</th>
                            <th class="text-center border">Phone</th>
                            <th class="text-center border">Message</th>
                        </tr>
                        <?php
                            $trainer_info = $conn->prepare("select t.id, t.name, t.surname, t.birthdate, t.gender, t.email, t.phone_number, e.profession from trainer as t inner join trainer_expertise as te on t.id=te.trainer_id inner join expertise as e on te.expertise_id=e.id inner join match_clients as mc on t.id=mc.trainer_id where mc.client_id=:client_id and t.state=1 order by t.id");
                            $trainer_info->execute(array("client_id"=>$_SESSION["client_id"]));
                            while ($results = $trainer_info->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td class="text-center border"><?php echo $results["name"] ; ?></td>
                                <td class="text-center border"><?php echo $results["surname"]; ?></td>
                                <td class="text-center border"><?php echo $results["profession"]; ?></td>
                                <td class="text-center border"><?php echo $results["birthdate"]; ?></td>
                                <td class="text-center border"><?php echo $results["gender"]; ?></td>
                                <td class="text-center border"><?php echo $results["email"]; ?></td>
                                <td class="text-center border"><?php echo $results["phone_number"]; ?></td>
                                <td class="border text-center">
                                    <a href="client-write-message?id=<?php echo $results['id']; ?>">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
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