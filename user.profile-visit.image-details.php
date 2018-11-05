<?php
require('db.php');
include("auth.php");
include("getInfo.php");
//include("autoReload.php");
include 'class/Member.php';
include 'class/Image.php';
include 'class/LikePost.php';
include 'class/CommentPost.php';

if (isset($_REQUEST['submitImg'])) {
    $_SESSION['ImageTitle'] = $_REQUEST['imgTitle'];
    $_SESSION['ImageUrl'] = $_REQUEST['imgURL'];
    $_SESSION['ImageID'] = $_REQUEST['imgID'];

}
if (isset($_POST['reason'])) {
    $profile_name = $_SESSION['profile_visit_name'];
    $profile_email = $_SESSION['profile_visit_email'];
    $reporting_reason = stripslashes($_REQUEST['reason']);
    $reporting_reason = mysqli_real_escape_string($con, $reporting_reason);
    $member = new Member();
    $member->reportUser($userName, $profile_name, $profile_email, $reporting_reason);
}
if (isset($_POST['like'])) {
    $imgURL = $_SESSION['ImageUrl'];
    $image = new LikePost();
    $image->likeImage($_SESSION['ImageID'], $user_id);
    header('Location: user.profile-visit.image-details.php');
}
if (isset($_POST['unlike'])) {
    $imgURL = $_SESSION['ImageUrl'];
    $image = new LikePost();
    $image->unlikeImage($_SESSION['ImageID'], $user_id);
    header('Location: user.profile-visit.image-details.php');
}
if (isset($_POST['Comment'])) {
    $remark = $_REQUEST['message'];
    $img_id = $_SESSION['ImageID'];
    $img_com = new CommentPost();
    $img_com->storeComment($user_id,$img_id,$remark);
    header('Location: user.profile-visit.image-details.php');
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
                        <!-- Search-->
                        <!--<li class="nav-item d-flex align-items-center"><a id="search" href="#"><i
                                        class="icon-search"></i></a></li>-->
                        <!-- Logout    -->
                        <li class="nav-item"><a href="logout.php" class="nav-link logout">Logout<i
                                        class="fa fa-sign-out"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <div class="page-content d-flex align-items-stretch">
        <div id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                <input type="submit" value="Report" name="Report_button" class="btn btn-primary">
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


        <!-- Side Navbar -->
        <nav class="side-navbar">
            <!-- Sidebar Navidation Menus-->
            <ul class="list-unstyled">

                <?php
                if ($role_id == 2) {
                    echo '<li><a href="user.home.php"><i class="icon-home"></i>Back to Home </a></li>';
                } else
                    echo '<li><a href="admin.home.php"><i class="icon-home"></i>Back to Home </a></li>';
                ?>

                <div class="container wrap">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="well well-sm jumbotron">
                                <h4><?php echo $_SESSION['profile_visit_name'] ?></h4>
                                <button class="btn btn-secondary btn-block" data-toggle="modal" data-target="#myModal2">
                                    Report User
                                </button>
                                <button class="btn btn-secondary btn-block"
                                        onclick="location.href='user.profile-visit.php'">View Gallery
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        </nav>
        <div class="content-inner">
            <!-- Page Header-->


            <div class="page-content">
                <!--Report Modal-->
                <div class="container">
                    <div class="pp-section pp-container-readable" style="background-color: white">
                        <div class="pp-post"><a class="h3">Image Title</a>
                            <div class="pp-post-meta mt-2">
                                <ul>
                                    <li><i class="fa fa-comments" aria-hidden="true"></i><a
                                                href="#pp-comment">Comments</a></li>

                                    <?php
                                    $IMAGE = new LikePost();
                                    $RESULT = $IMAGE->fetchUser($_SESSION['ImageID']);
                                    $showLike = mysqli_num_rows($RESULT)
                                    ?>
                                    <li><i class="fa fa-thumbs-up"></i><a data-toggle="modal" data-target="#myModal"
                                                                          href=""><?php echo $showLike ?></a></li>
                                </ul>
                            </div>
                            <?php
                            $sh = '<img class="img-fluid mt-3" src=" ' . $_SESSION['ImageUrl'] . '" alt="Blog Image"/>';
                            echo $sh;
                            ?>
                            <br/><br/>

                            <?php

                            $check = $IMAGE->checkLike($_SESSION['ImageID'], $user_id);

                            if ($check != 1) {

                                $likeButton = '<form method="POST">
                                    <input type="submit" class="btn btn-default btn-lg" class="fa fa-thumbs-up" name="like" value="Like" >
                                    </form>';
                            } else {
                                $likeButton = '<form method="POST">
                                    <input type="submit" class="btn btn-default btn-lg" class="fa fa-thumbs-up" name="unlike" value="Unlike" >
                                    </form>';
                            }
                            echo $likeButton;

                            ?>

                        </div>

                        <!--people who likes it modal-->
                        <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true" class="modal fade text-left">
                            <div role="document" class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 id="exampleModalLabel" class="modal-title">People who liked</h4>
                                        <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                                            <span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            <?php
                                            $fetchUID = $IMAGE->fetchUser($_SESSION['ImageID']);
                                            while ($f = mysqli_fetch_assoc($fetchUID)) {
                                                $showLikers = $IMAGE->showUsers($f['user_id']);
                                                while ($sh = mysqli_fetch_assoc($showLikers)) {
                                                    $liker = $sh['name'];
                                                    $SHOW = '<li class="list-group-item">' . $liker . '</li>';
                                                    echo $SHOW;
                                                }
                                            }
                                            ?>


                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="pp-blog-details">
                            <div class="pp-comments" id="pp-comment">
                                <div class="h2">Comments</div>
                                
                                    <div class="media-body">
                                        <?php 
                                            $imageCom = new CommentPost();
                                            $comIdRes = $imageCom->showCommentID($_SESSION['ImageID']);
                                            while($cidRes=mysqli_fetch_array($comIdRes)){
                                                $comRes = $imageCom->getCommentInfo($cidRes['comment_id']);
                                                while($showComment = mysqli_fetch_array($comRes)){
                                                    $Remark = $showComment['remark'];
                                                    $commenterName = $imageCom->showCommenters($showComment['user_id']);
                                                
                                                    $COMMENT = '
                                                    <div class="media"><img class="img-fluid mr-3" src="img/profile.png" alt="Image"/>
                                                    <div class="media-body">
                                                    <div class="h5 mt-0">'.$commenterName.'</div>
                                                    <p>'.$Remark.'</p>
                                                    </div>
                                                    </div>';
                                                    echo $COMMENT;
                                                }
                                            }

                                        ?>

                                    
                                </div>
                            </div>
                        </div>
                        <div class="pp-section"></div>
                        <div class="row" id="pp-drop-comment">
                            <div class="col">
                                <div class="h4 mb-3">Drop a Comment</div>
                                <form action="" method="POST">
                                    <div class="row mb-3">
                                        <div class="col">
                                    <input class="form-control" type="text" name="message"
                                              placeholder="*Your Message">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                           <input type="submit" class="btn btn-primary" name="Comment" value="Post Comment">

                                        </div>
                                    </div>
                                    <br/>
                                </form>
                            </div>
                        </div>
                    </div>
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
<script src="js/sweetalert.min.js"></script>
<!-- Main File-->
<script src="js/user/front.js"></script>

</body>
</html>