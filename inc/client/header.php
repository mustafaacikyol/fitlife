<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar fixed-top" style="padding-left: 20px;">
        <a class="navbar-brand" href="client-dashboard">Client Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ml-auto" id="navbarNav" style="display: flex; justify-content: flex-end;margin-right:80px;">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Profile
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <!-- Dropdown items go here -->
                        <a class="dropdown-item" href="client-dashboard"><?php echo($_SESSION["client"]) ?></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="client-information">Profile Information</a>
                        <a class="dropdown-item" href="update-client-info">Update Profile</a>
                        <a class="dropdown-item" href="change-client-image">Change Image</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="client-dashboard?user=logout"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                    </div>
                </li>
                <li class="nav-item">
                    <?php
                        $query = $conn->prepare("select profile_photo from client where id=:id");
                        $query->execute(array("id" => $_SESSION["client_id"]));
                        $image_result = $query->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <img src="assets/img/client/<?php echo $image_result['profile_photo'] ?>" alt="Client Profile" class="profile-photo">
                </li>
            </ul>
        </div>
    </nav>