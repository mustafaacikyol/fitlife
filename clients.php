<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/admin/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Clients</title>
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
                                <th colspan="11" class="text-center py-2">CLIENTS</th>
                            </tr>
                            <tr>
                                <th class="text-center border">Order</th>
                                <th class="text-center border">Name</th>
                                <th class="text-center border">Surname</th>
                                <th class="text-center border">Target</th>
                                <th class="text-center border">Birthdate</th>
                                <th class="text-center border">Gender</th>
                                <th class="text-center border">Email</th>
                                <th class="text-center border">Phone</th>
                                <th class="text-center border">State</th>
                                <th class="text-center border">Update</th>
                                <th class="text-center border">Delete</th>
                            </tr>
                            <?php
                                $update = $conn -> prepare("update client set state=:state where id=:id");
                                $update -> execute (array("state" => $_GET["state"], "id" => $_GET["id"]));
                                $delete_client_target =  $conn ->  prepare("delete from client_target where client_id=:client_id");
                                $delete_client_target -> execute (array("client_id" => $_GET["del_id"]));
                                $delete =  $conn ->  prepare("delete from client where id=:id");
                                $delete -> execute (array("id" => $_GET["del_id"]));
                                $counter = 1;
                                $client_info = $conn->prepare("select c.id, c.name, c.surname, c.birthdate, c.gender, c.email, c.phone_number, c.state, e.profession from client as c inner join client_target as ct on c.id=ct.client_id inner join expertise as e on ct.target_id=e.id order by c.id");
                                $client_info->execute();
                                while ($results = $client_info->fetch(PDO::FETCH_ASSOC)) {
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
                                                echo "<a href='clients?state=0&id=$id'><i class='far fa-check-circle text-success'></i></a>";
                                            } else {
                                                echo "<a href='clients?state=1&id=$id'><i class='far fa-times-circle text-danger'></i></a>";
                                            }  
                                        ?>
                                    </td>
                                    <td class="border text-center">
                                        <a href="update-client?id=<?php echo $results['id']; ?>">
                                            <i class="fas fa-user-edit"></i>
                                        </a>
                                    </td>
                                    <td class="border text-center">
                                        <a href="clients/?del_id=<?php echo $results['id']; ?>" onclick="return confirm('The client you selected will be deleted. Are you sure?')" title="<?php echo $results['name'] . ' ' . $results['surname']; ?> will be deleted">
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