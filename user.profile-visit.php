<?php
require('db.php');
include("auth.php");
include("getInfo.php");
//include("autoReload.php");
include 'class/Member.php';
include 'class/Image.php';

if (isset($_REQUEST['EmailReported'])) {
    $_SESSION['profile_visit_email'] = $_REQUEST['EmailReported'];
     $_SESSION['profileId'] = $_REQUEST['reportedId'];
    $_SESSION['profile_visit_name'] = $_REQUEST['reportedName'];
   

}

if (isset($_REQUEST['email_address'])) {
    $_SESSION['profile_visit_email'] = $_REQUEST['email_address'];
    $_SESSION['profile_visit_name'] = $_REQUEST['Resultname'];
    $_SESSION['profileId'] = $_REQUEST['profile_id'];

}


$profile_id = $_SESSION['profileId'];
$img = new Image();
$record = $img->showImage($profile_id);
$numberOfImage = $img->countImage($profile_id);
if (isset($_POST['submitImg'])) {
    header("Location: user.profile-visit.image-details.php");
}

if (isset($_POST['reason'])) {
    //echo $_REQUEST['reason'];
    $profile_name = $_SESSION['profile_visit_name'];
    $profile_email = $_SESSION['profile_visit_email'];
    //echo $userName;
    //echo $email_address;
    $reporting_reason = stripslashes($_REQUEST['reason']);
    $reporting_reason = mysqli_real_escape_string($con, $reporting_reason);
    // echo $reporting_reason;
    $member = new Member();
    $member->reportUser($userName, $profile_name, $profile_email, $reporting_reason);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">-->
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
    <link rel="stylesheet" href="css/gallery.css">
    <link rel="stylesheet" href="css/profile-card.css">
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
            <!-- Sidebar Navidation Menus-->
            <ul class="list-unstyled">

                <?php
                if ($role_id == 2) {
                    echo '<li><a href="user.home.php"><i class="icon-home"></i>Back to Home</a></li>';
                } else
                    echo '<li><a href="admin.home.php"><i class="icon-home"></i>Back to Home </a></li>';
                ?>

            </ul>
            <div class="container wrap">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="well well-sm jumbotron">
                            <h4><?php echo $_SESSION['profile_visit_name'] ?></h4>
                            <p>
                                Drawings : <?php echo mysqli_num_rows($numberOfImage)?>
                            </p>
                            <button class="btn btn-secondary btn-block" data-toggle="modal" data-target="#myModal">
                                Report User
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </nav>
        <div class="content-inner">
            <!-- Page Header-->
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">Gallery</h2>
                </div>
            </header>

            <div class="page-content">
                <?php
                if (mysqli_num_rows($numberOfImage)==0){
                    echo '
                        <section>
                            <div class="container-fluid"> 
                              <div class="card">
                                  <div class="card-body">
                                      <p align="center">No image found</p>
                                  </div>
                              </div>
                          </div>   
                        </section>';
                }
                ?>
                <!--report user modal-->
                <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true" class="modal fade text-left">
                    <div role="document" class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 id="exampleModalLabel" class="modal-title">Report user</h4>
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                                    <span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <div class="form-group">
                                        <label class="form-control-label">Why are you reporting this user?</label>
                                        <input type="text" name="reason" placeholder="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Report" name="Report_button"
                                               class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="container px-6">
                        <div class="pp-gallery">
                            <!--<div class="card-columns">-->
                            <div class="card-columns">

                                <?php
                                while ($show = mysqli_fetch_assoc($record)) {
                                    $imageurl = $show['image_path'];
                                    $title = $show['image_name'];
                                    $imageID = $show['image_id'];
                                    $IMG = new Image();
                                    $check = $IMG->checkImage($imageurl);
                                    if ($check == 0) {
                                        $display = '
                                        
                                        <div class="card">
                                        <form method="POST" action="user.profile-visit.image-details.php">
                                            <button class = "btn" type="submit" name="submitImg" value="View image">
                                                <figure class="pp-effect"><img class="img-fluid" src="' . $imageurl . '" alt="Nature"/>
                                                    <figcaption>
                                                        <div class="h4">' . $title . '</div>
                                                    </figcaption>
                                                </figure>
                                                <input type="hidden" name="imgTitle" value="' . $title . '" class="form-control">
                                                <input type="hidden" name="imgURL" value="' . $imageurl . '" class="form-control">
                                                <input type="hidden" name="imgID" value="' . $imageID . '" class="form-control">
                                            </button>  
                                        </form>  
                                        </div>';
                                        echo $display;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="pp-section"></div>
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
<script src="vendor/popper.js/umd/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/jquery.cookie/jquery.cookie.js"></script>
<script src="vendor/jquery-validation/jquery.validate.min.js"></script>

<!-- Main File-->
<script src="js/user/front.js"></script>

</body>
</html>