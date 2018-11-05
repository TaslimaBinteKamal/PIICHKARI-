<?php
require('db.php');
include("auth.php");
include ("getInfo.php");
include 'class/Image.php';


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Piichkari</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="vendor/fonts/sans.css">
    <link rel="stylesheet" href="vendor/fonts/merriweather.css">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/fontastic.css">
    <link rel="stylesheet" href="css/user.default.css">
    <link rel="stylesheet" href="css/canvas.css">
    <link rel="stylesheet" type="text/css" media="all" href="vendor/jquery/jquery.minicolors.css">
    <link href="css/literallycanvas.css" rel="stylesheet">

</head>
<body>
<div class="page">
    <!-- Main Navbar-->
    <header class="header">
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <!-- Navbar Header-->
                    <div class="navbar-header">
                        <!-- Navbar Brand --><a href="index.php" class="navbar-brand">
                            <div class="brand-text brand-big"><span>Piichkari </span><strong>Logo</strong></div>
                            <div class="brand-text brand-small"><strong>Logo</strong></div>
                        </a>
                        <!-- Toggle Button--><a id="toggle-btn" href="#"
                                                class="menu-btn active"><span></span><span></span><span></span></a>
                    </div>
                    <!-- Navbar Menu -->
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <!-- Logout    -->
                        <li class="nav-item"><a href="logout.php" class="nav-link logout">Logout<i
                                        class="fa fa-sign-out"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar">
            <!-- Sidebar Header-->
                        <div class="sidebar-header d-flex align-items-center">
                            <div class="avatar"><img src="img/profile.png" alt="..." class="img-fluid rounded-circle"></div>
                            <div class="title">
                                <h1 class="h4"><?php echo $userName; ?>
                            </div>
                        </div>
            <!-- Sidebar Navidation Menus-->
            <ul class="list-unstyled">
               <?php
				if($role_id==2){
					echo '<li><a href="user.home.php"><i class="icon-home"></i>Home </a></li>';
				}
				else
					echo '<li><a href="admin.home.php"><i class="icon-home"></i>Home </a></li>';
			?>
                <li><a href="user.gallery.php"><i class="icon-grid"></i>Gallery</a></li>
                <li class="active"><a href="user.canvas.php"><i class="icon-picture"></i>Canvas</a></li>
                <li><a href="user.profile.php"><i class="icon-interface-windows"></i>Profile</a></li>
            </ul>
        </nav>
        <div class="content-inner">
            <!-- Page Header-->
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">Canvas</h2>
                </div>
            </header>
            <div class="page-content">
                <!-- Main canvas-->

                <div class="row" style="padding-top: 10px; padding-left: 100px">
                    <div class="col-lg-10">
                        <div class="my-drawing" style=" border:1px solid #E6E6E6;"></div>
                        <button type="button" class="btn btn-secondary dropdown-toggle float-right"
                                data-toggle="dropdown">
                            Download
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item" onclick="downloadPNG()">PNG</button>
                            <button class="dropdown-item" onclick="downloadJPG()">JPG</button>
                        </div>
                        <form method="POST" action="user.canvas.php" style="display: inline;" class="float-right form-inline">
                            <input class="mr-2 form-control" name="imageTitle" style=" border:1px solid #727B84;" id="imageTitle"
                                   type="text" required placeholder="Give a Title">
                            <input id = "imageDataURL" type="hidden" name="imageDataURL" value="">
                            <button type="submit" onclick="save()" name="submitImageToSave" class="btn btn-secondary float-right" style="margin-right: 5px">Save
                            </button>
                        </form>

                    </div>

                </div>

                <footer class="main-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>Paint Your Dreams</p>
                            </div>
                            <div class="col-sm-6 text-right">
                                <p>Design by Piichkari</p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <!-- Javascript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/jquery/jquery.minicolors.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>

    <!-- dependency: React.js -->
    <script src="js/react-with-addons.js"></script>
    <script src="js/react-dom.js"></script>

    <!-- Literally Canvas -->
    <script src="js/literallycanvas.js"></script>
    <!-- Main File-->
    <script src="js/canvas.js"></script>
    <script src="js/user/front.js"></script>
    <script src="vendor/sweet-alert/sweetalert.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['imageTitle'])){
    $imageTitle = $_REQUEST['imageTitle'];
    $imageDataURL = $_REQUEST['imageDataURL'];
    $image = new Image();
    $image->saveImage($imageTitle,$imageDataURL,$user_id);
    if ($image){
        echo "<script>swal(\"Drawing has been saved.\", \"Check gallery\", \"success\");</script>";
    }
}
?>