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
                    <h2 class="text-center mt-3 mb-5">Admin Dashboard</h2>
                    <?php 
                        if (isset($_POST["matchBtn"])) {
                            $trainer_info = $conn->prepare("SELECT t.id, t.name, t.surname, t.birthdate, t.gender, t.email, t.phone_number, t.state, e.profession FROM trainer AS t INNER JOIN trainer_expertise AS te ON t.id=te.trainer_id INNER JOIN expertise AS e ON te.expertise_id=e.id ORDER BY t.id");
                            $trainer_info->execute();
                            $trainer_results = $trainer_info->fetchAll(PDO::FETCH_ASSOC);
                        
                            $client_info = $conn->prepare("SELECT c.id, c.name, c.surname, c.birthdate, c.gender, c.email, c.phone_number, c.state, e.profession FROM client AS c INNER JOIN client_target AS ct ON c.id=ct.client_id INNER JOIN expertise AS e ON ct.target_id=e.id ORDER BY c.id");
                            $client_info->execute();
                            $client_results = $client_info->fetchAll(PDO::FETCH_ASSOC);
                        
                            $trainers = $trainer_results;
                            $clients = $client_results;
                        
                            foreach ($trainers as $trainer) {
                                $counter = 0;
                                foreach ($clients as $key => $client) {
                                    if ($trainer["profession"] == $client["profession"]) {
                                        $insert_to_match_clients = $conn->prepare("INSERT INTO match_clients SET trainer_id=:trainer_id, client_id=:client_id");
                                        $insert_to_match_clients_result = $insert_to_match_clients->execute(array("trainer_id" => $trainer["id"], "client_id" => $client["id"]));
                        
                                        unset($clients[$key]); // Remove the matched client from the array
                                        $counter++;
                                        if ($counter == 5) {
                                            break;
                                        }
                                    }
                                }
                            }
                        
                            if (count($clients) == 0) {
                                echo "<div class='alert alert-icon alert-success text-center' role='alert'>
                                            <em class='icon ni ni-check-circle'></em> 
                                            <strong>Matching process is completed</strong>. 
                                        </div>";
                                header("refresh:2;url=admin-dashboard");
                            }
                        }
                        
                    ?>
                    <form action="" method="post">
                        <div class="text-center">
                            <p>Press the button to start the matching</p>
                        </div>
                        <div class="form-group mt-3 text-center">
                            <button type="submit" class="btn btn-md btn-round btn-primary" name="matchBtn">Start Matching</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include_once("inc/dashboard_js.php") ?>

</body>
</html>