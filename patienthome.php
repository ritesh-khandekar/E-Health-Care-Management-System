<?php
session_start();
if (!isset($_SESSION["hms_login"])) {
    header("location: ./");
}
if ($_SESSION["hms_doctor"]) {
    echo $_SESSION["hms_doctor"];
    header("location: doctorhome.php?" . $_SERVER['QUERY_STRING']);
    return;
}
if ($_SESSION["hms_admin"]) {
    header("location: adminhome.php?" . $_SERVER['QUERY_STRING']);
    return;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOSPITAL MANAGEMENT SYSTEM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="pt-4">
    <nav class="navbar navbar-expand-lg p-2 px-4 fixed-top navbar-light bg-white shadow-sm">
        <a class="navbar-brand" href="#"><img src="./images/logo.png" height="50px" alt="Logo of Hospital Management System"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ml-auto mr-0 mt-2 mt-lg-0">
                <li class="nav-item"><a class="nav-link m-1 active btn bg-secondary text-white" style="color: #000;text-decoration:none" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="alldoctors.php">All Doctors</a></li>
                <li class="nav-item"><a class="nav-link m-1 mr-5" style="color: #000;text-decoration:none" href="pharmacy.php">Pharmacy</a></li>
                <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="dashboard.php">DASHBOARD</a></li>
                <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="logout.php">LOGOUT</a></li>
            </ul>
        </div>
    </nav>
    <main class="container p-2 pt-4 mt-4">
        <?php
        if (isset($_GET["success"])) :
        ?>
            <div class="text-center w-100">
                <div class="alert alert-success mx-auto w-50">Login Successful</div>
            </div>
        <?php endif ?>
        <div class="h4 py-3 text-white">Welcome to Hospital Management System Dashboard:</div>
        <div class="d-flex justify-content-between">
            <div style="cursor: pointer;" onclick="this.querySelector('a').click()" class="dashboard-link p-2 m-2 text-center rounded bg-transparent w-25 shadow bg-blur p-4">
                <div style="font-size: 60px;" class="text-white p-3 d-block fa fa-home"></div>
                <a class="text-decoration-none text-white" href="./home.php">
                    <b>HOME</b>
                </a>
            </div>

            <div style="cursor: pointer;" onclick="this.querySelector('a').click()" class="dashboard-link p-2 m-2 text-center rounded bg-transparent w-25 shadow bg-blur p-4">
                <div style="font-size: 60px;" class="text-white p-3 d-block fa fa-user-md"></div>
                <a class="text-decoration-none text-white" href="./alldoctors.php">
                    <b>ALL DOCTORS</b>
                </a>
            </div>

            <div style="cursor: pointer;" onclick="this.querySelector('a').click()" class="dashboard-link p-2 m-2 text-center rounded bg-transparent w-25 shadow bg-blur p-4">
                <div style="font-size: 60px;" class="text-white p-3 d-block fa fa-calendar"></div>
                <a class="text-decoration-none text-white" href="./myappointments.php">
                    <b>MY APPOINTMENTS</b>
                </a>
            </div>
            <div style="cursor: pointer;" onclick="this.querySelector('a').click()" class="dashboard-link p-2 m-2 text-center rounded bg-transparent w-25 shadow bg-blur p-4">
                <div style="font-size: 60px;" class="text-white p-3 d-block fa fa-user"></div>
                <a class="text-decoration-none text-white" href="./myaccount.php">
                    <b>MY ACCOUNT</b>
                </a>
            </div>
        </div>
        </div>
    </main>
    <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>© 2017-2018 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>