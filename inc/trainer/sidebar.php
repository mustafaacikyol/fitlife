<!-- Sidebar -->
<nav class="col-md-2 d-none d-md-block sidebar sidebar-sticky">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="trainer-dashboard">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="clientsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-users"></i> Clients
                </a>
                <div class="dropdown-menu" aria-labelledby="clientsDropdown">
                    <!-- Dropdown items for Clients go here -->
                    <a class="dropdown-item" href="clients">Display</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Another Client</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-users"></i> Messages
                </a>
                <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                    <!-- Dropdown items for Clients go here -->
                    <a class="dropdown-item" href="trainer-incoming-message?id=<?php echo $_SESSION['id'] ?>">Incoming messages</a>
                    <a class="dropdown-item" href="trainer-sent-message?id=<?php echo $_SESSION['id'] ?>">Sent messages</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="trainer-write-message">Write message</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="exerciseDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-users"></i> Exercise
                </a>
                <div class="dropdown-menu" aria-labelledby="exerciseDropdown">
                    <!-- Dropdown items for Clients go here -->
                    <a class="dropdown-item" href="clients">Generate</a>
                    <a class="dropdown-item" href="clients">Display</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="nutritionDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-users"></i> Nutrition
                </a>
                <div class="dropdown-menu" aria-labelledby="nutritionDropdown">
                    <!-- Dropdown items for Clients go here -->
                    <a class="dropdown-item" href="clients">Generate</a>
                    <a class="dropdown-item" href="clients">Display</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="trainer-dashboard">
                    <i class="fas fa-cogs"></i> Settings
                </a>
            </li>
        </ul>
    </div>
</nav>
