<?php
session_start();
include_once 'util/db_util.php';
include_once 'db.function/artists_function.php';
include_once 'db.function/albums_function.php';
include_once 'db.function/user_function.php';
if (!isset($_SESSION['my_session'])) {
    $_SESSION['my_session'] = false;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <title>PHP Navigation and Send Data</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <link rel="stylesheet" type="text/css" href="css/web_style.css">
    <link rel="stylesheet" type="text/css" href="css/datatables.css">

    <script type="text/javascript" src="js/functional_js.js"></script>
    <script type="text/javascript" src="js/command_script.js"></script>
</head>

<body>
    <!--Tag for header-->
    <header>
        <h1>Pemrograman Web 2</h1>
    </header>
    <!--Tag for navigation-->
    <nav>
        <ul>
            <li><a href="?navito=home">Home</a></li>
            <li><a href="?navito=about">About</a></li>
            <li><a href="?navito=example">Example</a></li>
            <li><a href="?navito=artists">Artists</a></li>
            <li><a href="?navito=albums">Albums</a></li>
            <?php
            if ($_SESSION['my_session']) {
                echo '<li><a href="?navito=logout">Logout</a></li>';
            } else {
                echo '<li><a href="?navito=login">Login</a></li>';
            }
            ?>
        </ul>
    </nav>
    <div style="clear:both;"></div>
    <!--Tag for content-->
    <main>
        <?php
        $nav = filter_input(INPUT_GET, "navito");
        switch ($nav) {
            case 'home':
                include_once './home.php';
                break;
            case 'about':
                include_once './about.php';
                break;
            case 'example':
                include_once './example.php';
                break;
            case 'artists':
                include_once './artists.php';
                break;
            case 'artistsu':
                include_once './artists_update.php';
                break;
            case 'albums':
                include_once './albums.php';
                break;
            case 'albumsu':
                include_once './albums_update.php';
                break;
            case 'login':
                include_once './login_page.php';
                break;
            case 'logout':
                session_unset();
                session_destroy();
                header("location:index.php");
            default:
                include_once './home.php';
                break;
        }
        ?>
    </main>
    <!--Tag for footer-->
    <footer>
        Created by Robby Tan & Modified by Maresha
    </footer>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

    <!-- Datatable -->
    <script type="text/javascript" src="js/datatables.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tableId').DataTable();
        });
    </script>
</body>

</html>