<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/trainer/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Trainer Send Message</title>
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
                            <th colspan="3" class="text-center py-2">SEND MESSAGES</th>
                        </tr>
                        <tr>
                            <th class="text-center border">Order</th>
                            <th class="text-center border">Message</th>
                            <th class="text-center border">To</th>
                        </tr>
                        <?php
                            $counter = 1;
                            $message_info = $conn->prepare("select m.content, c.name, c.surname from message as m inner join client as c on m.client_id=c.id where m.trainer_id=:trainer_id and m.direction=1 and m.state=1 order by m.id");
                            $message_info->execute(array("trainer_id"=>$_SESSION["id"]));
                            while ($results = $message_info->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td class="text-center border"><?php echo $counter ; ?></td>
                                <td class="text-center border"><?php echo $results["content"] ; ?></td>
                                <td class="text-center border"><?php echo $results["name"] . " " . $results["surname"] ; ?></td>
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