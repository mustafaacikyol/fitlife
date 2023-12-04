<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/trainer/session.php");
    $client_info = $conn->prepare("select name, surname from client where id=:id");
    $client_info->execute(array("id"=>$_GET["id"]));
    $client_results = $client_info->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Trainer Display Progress</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>
    <?php include_once("inc/trainer/header.php") ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("inc/trainer/sidebar.php") ?>

            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="content">
                    <div style="display: flex; justify-content: flex-end; margin-bottom:15px;">
                        <span style="font-weight: 700;"><?php echo $client_results["name"] . " " . $client_results["surname"] ?></span>
                    </div>
                    <table class="border" style="width: 100%;margin-bottom:60px;">
                        <tr class="border">
                            <th colspan="6" class="text-center py-2">PROGRESS RECORDS</th>
                        </tr>
                        <tr>
                            <th class="text-center border">Day</th>
                            <th class="text-center border">Weight</th>
                            <th class="text-center border">Tall</th>
                            <th class="text-center border">Body Mass Index</th>
                            <th class="text-center border">Muscle Mass</th>
                            <th class="text-center border">Body Fat Ratio</th>
                        </tr>
                        <?php
                            $counter = 1;
                            $exercise_info = $conn->prepare("select p.id, p.weight, p.tall, p.body_mass_index, p.muscle_mass, p.body_fat_ratio from progress as p inner join client_progress as cp on p.id=cp.progress_id where cp.client_id=:client_id order by p.id");
                            $exercise_info->execute(array("client_id"=>$_GET["id"]));
                            while ($results = $exercise_info->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td class="text-center border"><?php echo $counter ; ?></td>
                                <td class="text-center border"><?php echo $results["weight"] ; ?></td>
                                <td class="text-center border"><?php echo $results["tall"]; ?></td>
                                <td class="text-center border"><?php echo $results["body_mass_index"]; ?></td>
                                <td class="text-center border"><?php echo $results["muscle_mass"]; ?></td>
                                <td class="text-center border"><?php echo $results["body_fat_ratio"]; ?></td>
                            </tr>
                        <?php $counter++;
                        }
                        ?>
                        
                    </table>

                    <?php 
                        $query = $conn->prepare("select p.weight, p.tall, p.body_mass_index, p.muscle_mass, p.body_fat_ratio from progress as p inner join client_progress as cp on p.id=cp.progress_id where cp.client_id=:client_id");
                        $query->execute(array("client_id" => $_GET["id"]));
                    
                        $data = [];
                        while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
                            $data[] = $result;
                        }
                    
                        // Convert data to JSON
                        $json_data = json_encode($data);
                    ?>

                    <canvas id="weightChart" style="width:100%;max-width:900px;margin-bottom:60px;"></canvas>
                    <canvas id="tallChart" style="width:100%;max-width:900px;margin-bottom:60px;"></canvas>
                    <canvas id="bodyMassIndexChart" style="width:100%;max-width:900px;margin-bottom:60px;"></canvas>
                    <canvas id="muscleMassChart" style="width:100%;max-width:900px;margin-bottom:60px;"></canvas>
                    <canvas id="bodyFatRatioChart" style="width:100%;max-width:900px;margin-bottom:60px;"></canvas>

                    <script>
                        const xValues = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];
                        
                        // Assuming you have a variable $json_data with your JSON data
                        var json_data = <?php echo $json_data; ?>;

                        var weights = json_data.map(function(item) {
                            return item.weight;
                        });

                        var talls = json_data.map(function(item) {
                            return item.tall;
                        });

                        var bodyMassIndexes = json_data.map(function(item) {
                            return item.body_mass_index;
                        });

                        var muscleMasses = json_data.map(function(item) {
                            return item.muscle_mass;
                        });

                        var bodyFatRatios = json_data.map(function(item) {
                            return item.body_fat_ratio;
                        });

                        new Chart("weightChart", {
                        type: "line",
                        data: {
                            labels: xValues,
                            datasets: [{
                            fill: false,
                            lineTension: 0,
                            backgroundColor: "rgba(0,0,255,1.0)",
                            borderColor: "rgba(0,0,255,0.1)",
                            data: weights
                            }]
                        },
                        options: {
                            title: {
                            display: true,
                            text: 'Weight Chart', // Set the chart title here
                            fontSize: 16
                        },
                            legend: {display: false}
                        }
                        });

                        new Chart("tallChart", {
                        type: "line",
                        data: {
                            labels: xValues,
                            datasets: [{
                            fill: false,
                            lineTension: 0,
                            backgroundColor: "rgba(0,0,255,1.0)",
                            borderColor: "rgba(0,0,255,0.1)",
                            data: talls
                            }]
                        },
                        options: {
                            title: {
                            display: true,
                            text: 'Tall Chart', // Set the chart title here
                            fontSize: 16
                        },
                            legend: {display: false}
                        }
                        });

                        new Chart("bodyMassIndexChart", {
                        type: "line",
                        data: {
                            labels: xValues,
                            datasets: [{
                            fill: false,
                            lineTension: 0,
                            backgroundColor: "rgba(0,0,255,1.0)",
                            borderColor: "rgba(0,0,255,0.1)",
                            data: bodyMassIndexes
                            }]
                        },
                        options: {
                            title: {
                            display: true,
                            text: 'Body Mass Index Chart', // Set the chart title here
                            fontSize: 16
                        },
                            legend: {display: false}
                        }
                        });

                        new Chart("muscleMassChart", {
                        type: "line",
                        data: {
                            labels: xValues,
                            datasets: [{
                            fill: false,
                            lineTension: 0,
                            backgroundColor: "rgba(0,0,255,1.0)",
                            borderColor: "rgba(0,0,255,0.1)",
                            data: muscleMasses
                            }]
                        },
                        options: {
                            title: {
                            display: true,
                            text: 'Muscle Mass Chart', // Set the chart title here
                            fontSize: 16
                        },
                            legend: {display: false}
                        }
                        });

                        new Chart("bodyFatRatioChart", {
                        type: "line",
                        data: {
                            labels: xValues,
                            datasets: [{
                            fill: false,
                            lineTension: 0,
                            backgroundColor: "rgba(0,0,255,1.0)",
                            borderColor: "rgba(0,0,255,0.1)",
                            data: bodyFatRatios
                            }]
                        },
                        options: {
                            title: {
                            display: true,
                            text: 'Body Fat Radio Chart', // Set the chart title here
                            fontSize: 16
                        },
                            legend: {display: false}
                        }
                        });

                    </script>
                </div>
            </main>
        </div>
    </div>

    <?php include_once("inc/dashboard_js.php") ?>

</body>
</html>