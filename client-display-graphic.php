<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/client/session.php");
    
    $query = $conn->prepare("select p.weight, p.tall, p.body_mass_index, p.muscle_mass, p.body_fat_ratio from progress as p inner join client_progress as cp on p.id=cp.progress_id where cp.client_id=:client_id");
    $query->execute(array("client_id" => $_SESSION["client_id"]));

    $data = [];
    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $result;
    }

    // Convert data to JSON
    $json_data = json_encode($data);
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Client Display Progress</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

</head>
<body>
    <?php include_once("inc/client/header.php") ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("inc/client/sidebar.php") ?>
            <!-- Main Content -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="content">

                    <canvas id="weightChart" style="width:100%;max-width:900px;margin-bottom:60px;"></canvas>
                    <canvas id="tallChart" style="width:100%;max-width:900px;margin-bottom:60px;"></canvas>
                    <canvas id="bodyMassIndexChart" style="width:100%;max-width:900px;margin-bottom:60px;"></canvas>
                    <canvas id="muscleMassChart" style="width:100%;max-width:900px;margin-bottom:60px;"></canvas>
                    <canvas id="bodyFatRatioChart" style="width:100%;max-width:900px;margin-bottom:60px;"></canvas>

                    <script>
                        const xValues = [1,2,3,4,5,6,7,8,9,10];
                        
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