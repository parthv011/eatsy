<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <style>
        #dashboard_menu {
            position: fixed;
            height: 100%;
        }

        @media screen and (max-width: 991px) {
            #dashboard_menu {
                width: 100%;
                height: auto;
                z-index: 1;
            }

            #main_content {
                margin-top: 60px;
            }

            .custom-bg {
                background-color: hsl(120, 61.80%, 60.00%);
                border: none;
            }

            .custom-bg:hover {
                background-color: hsl(120, 46.50%, 44.70%);
                border: none;
            }
        }
    </style>
    <?php require('links.php') ?>
</head>

<body>
    <div class="container-fluid bg-dark p-3 text-light align-items-center d-flex justify-content-between sticky-top">
        <h5 class="mb-0 h-font"><a href="dashboard.php" class=" text-light text-decoration-none">EATSYY</a></h5>
        <a href="" class="btn btn-sm btn-light">LOGOUT</a>
    </div>
    <div class="col-lg-2 bg-dark border-top border-3 border-secondary" id="dashboard_menu">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid flex-lg-column align-items-stretch">
                <h4 class="mt-2 text-light">ADMIN PANEL</h4>
                <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#admindropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="admindropdown">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="Settings.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="dashboard.php">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="rooms.php">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="features_facilities.php">My Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="Settings.php">Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</body>

</html>