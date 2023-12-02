<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/admin/session.php");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <?php include_once("inc/admin/header.php") ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("inc/admin/sidebar.php") ?>

            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="content">
                    <!-- Add your content here -->
                    <h2>Admin Dashboard</h2>
                    <?php 
                        function matchTrainerWithClient(){
                            global $conn;
                            $trainer_info = $conn->prepare("select t.id, t.name, t.surname, t.birthdate, t.gender, t.email, t.phone_number, t.state, e.profession from trainer as t inner join trainer_expertise as te on t.id=te.trainer_id inner join expertise as e on te.expertise_id=e.id order by t.id");
                            $trainer_info->execute();
                            $trainer_results = $trainer_info->fetchAll(PDO::FETCH_ASSOC);
                            $trainers = $trainer_results;
                            $client_info = $conn->prepare("select c.id, c.name, c.surname, c.birthdate, c.gender, c.email, c.phone_number, c.state, e.profession from client as c inner join client_target as ct on c.id=ct.client_id inner join expertise as e on ct.target_id=e.id order by c.id");
                            $client_info->execute();
                            $client_results = $client_info->fetchAll(PDO::FETCH_ASSOC);
                            $clients = $client_results;

                            for ($i=0; $i < count($trainers) ; $i++) { 
                                // echo $trainers[$i]["surname"];
                                
                                $counter = 0;
                                $iteration = count($clients);
                                for ($j=0; $j < $iteration; $j++) { 
                                    if ($trainers[$i]["profession"] == $clients[$j]["profession"]) {
                                        $insert_to_match_clients = $conn->prepare("insert into match_clients set trainer_id=:trainer_id, client_id=:client_id");
                                        $insert_to_match_clients_result = $insert_to_match_clients->execute(array("trainer_id" => $trainers[$i]["id"], "client_id" => $clients[$j]["id"]));
                                        echo count($clients);
                                        echo "-";
                                        array_splice($clients, $j, 1);
                                        echo count($clients);
                                        echo "\n";
                                        $counter++;
                                        if($counter == 5){
                                            break;
                                        }
                                    }
                                }
                                
                            }
                            
                            /*
                            while($trainer_results = $trainer_info->fetch(PDO::FETCH_ASSOC)){
                                $client_info = $conn->prepare("select c.id, c.name, c.surname, c.birthdate, c.gender, c.email, c.phone_number, c.state, e.profession from client as c inner join client_target as ct on c.id=ct.client_id inner join expertise as e on ct.target_id=e.id order by c.id");
                                $client_info->execute();
                                $counter = 0;
                                while($client_results = $client_info->fetch(PDO::FETCH_ASSOC)){
                                    if ($trainer_results["profession"] == $client_results["profession"]) {
                                        $insert_to_match_clients = $conn->prepare("insert into match_clients set trainer_id=:trainer_id, client_id=:client_id");
                                        $insert_to_match_clients_result = $insert_to_match_clients->execute(array("trainer_id" => $trainer_results["id"], "client_id" => $client_results["id"]));
                                    }
                                }
                    
                            }
                            */
                        }
                        matchTrainerWithClient();
                    ?>
                    <p>Welcome to the admin dashboard! Customize and add your content here.</p>
                </div>
            </main>
        </div>
    </div>

    <?php include_once("inc/dashboard_js.php") ?>

</body>
</html>