<?php

$currentPage = basename($_SERVER['PHP_SELF']);
?>
<style>
.navbar .nav-link {
    position: relative; 
    color: black !important;
    font-weight: bold;
    font-size: 17px;
    text-decoration: none;
    transition: color 0.3s ease;
}


.navbar .nav-link:hover {
    color: white !important;
}

.navbar .nav-link.active {
    color: white !important;
}

.navbar .nav-link::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -4px; 
    height: 2px;
    width: 0;
    background-color: black;
    transition: width 0.3s ease;
}

.navbar .nav-link:hover::after {
    width: 100%;
}

.navbar .nav-link.active::after {
    width: 100%;
}
</style>

<nav class="navbar navbar-expand-lg border border-top-0 border-start-0 border-end-0 border-3 border-dark" style="background-color:rgb(231, 181, 70, 1);">
    <div class="container">

        <a class="navbar-brand h1 mb-0" href="adminDashboard.php">
            <img class="me-3" src="resources/logo.svg" height="80" />
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse offset-lg-1" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-5">

                <li class="nav-item me-5">
                    <a class="nav-link <?php if ($currentPage == 'adminDashboard.php') echo 'active'; ?>" href="adminDashboard.php" style="font-size: 17px; font-weight: bold;">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item me-5">
                    <a class="nav-link <?php if ($currentPage == 'adminProductManage.php') echo 'active'; ?>" href="adminProductManage.php" style="font-size: 17px; font-weight: bold;">
                        Manage Product
                    </a>
                </li>

                <li class="nav-item me-5">
                    <a class="nav-link <?php if ($currentPage == 'adminManageUsers.php') echo 'active'; ?>" href="adminManageUsers.php" style="font-size: 17px; font-weight: bold;">
                        Manage Users
                    </a>
                </li>

                <li class="nav-item me-5">
                    <a class="nav-link <?php if ($currentPage == 'productAdding.php') echo 'active'; ?>" href="productAdding.php" style="font-size: 17px; font-weight: bold;">
                        Product Adding
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == 'productUpdate.php') echo 'active'; ?>" href="productUpdate.php" style="font-size: 17px; font-weight: bold;">
                        Product Updating
                    </a>
                </li>

            </ul>
        </div>

    </div>
</nav>
