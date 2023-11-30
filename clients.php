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
                                <th colspan="9" class="text-center py-2">CLIENTS</th>
                            </tr>
                            <tr>
                                <th class="text-center border dokuz">Order</th>
                                <th class="text-center border dokuz">Name</th>
                                <th class="text-center border onuc">Surname</th>
                                <th class="text-center sekiz border">Birthdate</th>
                                <th class="text-center border oniki">Gender</th>
                                <th class="text-center border on">Email</th>
                                <th class="text-center border on">Phone</th>
                                <th class="text-center border on">Update</th>
                                <th class="text-center border on">Delete</th>
                            </tr>
                            <?php
                                $delete =  $conn ->  prepare("delete from client where id=:id");
                                $delete -> execute (array("id" => $_GET["del_id"]));
                                $counter  =   1;
                                $client_info       =   $conn->prepare("select * from client order by id");
                                $client_info->execute();
                                while ($results    =   $client_info->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td class="text-center border"><?php echo $counter ; ?></td>
                                    <td class="text-center border"><?php echo $results["name"] ; ?></td>
                                    <td class="text-center border"><?php echo $results["surname"]; ?></td>
                                    <td class="text-center border"><?php echo $results["birthdate"]; ?></td>
                                    <td class="text-center border"><?php echo $results["gender"]; ?></td>
                                    <td class="text-center border"><?php echo $results["email"]; ?></td>
                                    <td class="text-center border"><?php echo $results["phone_number"]; ?></td>
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