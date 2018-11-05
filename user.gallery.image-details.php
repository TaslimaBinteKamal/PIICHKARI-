<?php
require('db.php');
include("auth.php");
include("getInfo.php");
include("autoReload.php");
include 'class/Image.php';
include 'class/LikePost.php';
include 'class/CommentPost.php';

 

if (isset($_REQUEST['submitImg'])) {
    $_SESSION['ImageTitle'] = $_REQUEST['imgTitle'];
    $_SESSION['ImageUrl'] = $_REQUEST['imgURL'];
    $_SESSION['ImageID'] = $_REQUEST['imgID'];

}
if (isset($_POST['like'])) {
    $imgURL = $_SESSION['ImageUrl'];
    $image = new LikePost();
    $image->likeImage($_SESSION['ImageID'], $user_id);
     header('Location: user.gallery.image-details.php');

}
if (isset($_POST['unlike'])) {
    $imgURL = $_SESSION['ImageUrl'];
    $image = new LikePost();
    $image->unlikeImage($_SESSION['ImageID'], $user_id);
     header('Location: user.gallery.image-details.php');

}
if (isset($_POST['Comment'])) {
    $remark = $_REQUEST['message'];
    $img_id = $_SESSION['ImageID'];
    $img_com = new CommentPost();
    $img_com->storeComment($user_id,$img_id,$remark);
    header('Location: user.gallery.image-details.php');
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
                            <li class="nav-item"><a href="index.php" class="nav-link logout">Logout<i
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
                        <h1 class="h4"><?php echo $userName; ?></h1>
                    </div>
                </div>
                <!-- Sidebar Navidation Menus-->
                <ul class="list-unstyled">
                    <?php
                    if ($role_id == 2) {
                        echo '<li><a href="user.home.php"><i class="icon-home"></i>Home </a></li>';
                    } else
                        echo '<li><a href="admin.home.php"><i class="icon-home"></i>Home </a></li>';
                    ?>
                    <li><a href="user.gallery.php"><i class="icon-grid"></i>Gallery</a></li>
                    <li><a href="user.canvas.php"><i class="icon-picture"></i>Canvas</a></li>
                    <li><a href="user.profile.php"><i class="icon-interface-windows"></i>Profile</a></li>
                    <hr/>
                    <li><a href="user.gallery.php">Back to Gallery</a></li>
                </ul>
            </nav>
            <div class="content-inner">
                <!-- Page Header-->


                <div class="page-content">
                    <div class="container">
                        <div class="pp-section pp-container-readable" style="background-color: white">
                            <div class="pp-post"><a class="h3"><?php echo $_SESSION['ImageTitle'] ?></a>
                                <div class="pp-post-meta mt-2">
                                    <ul>
                                        <li><i class="fa fa-comments" aria-hidden="true"></i><a
                                                    href="#pp-comment">Comments</a></li>
                                        <?php
                                        $IMAGE = new LikePost();
                                        $RESULT = $IMAGE->fetchUser($_SESSION['ImageID']);
                                        $showLike = mysqli_num_rows($RESULT)
                                        ?>
                                        <li><i class="fa fa-thumbs-up"></i>
                                            <a data-toggle="modal" data-target="#myModal"
                                               href=""><?php echo $showLike ?></a>
                                        </li>
                                    </ul>
                                </div>
                                <?php
                                $sh = '<img class="img-fluid mt-3" src=" ' . $_SESSION['ImageUrl'] . '" alt="Blog Image"/>';
                                echo $sh;
                                ?>
                                <br/><br/>

                                <form method="POST" class="pull-left">
                                    <?php
                                    $imgLike = new LikePost();
                                    $check = $imgLike->checkLike($_SESSION['ImageID'], $user_id);

                                    if ($check != 1) {
                                        $likeButton = '
                                    <input type="submit" class="btn btn-default btn-lg"  name="like" value="Like" >';
                                    } else {
                                        $likeButton = '
                                    <input type="submit" class="btn btn-default btn-lg" name="unlike" value="Unlike" >';
                                    }
                                    echo $likeButton;

                                    ?>
                                </form>
                                <form method="POST" action = "user.canvas.edit.php" class="pull-right float-left" style="padding-left: 5px">
                                    <input type="submit" class="btn btn-default btn-lg" name="edit" value="Edit">
                                </form>
                                <form method="POST" class="pull-right float-left" style="padding-left: 5px">
                                    <input type="submit" class="btn btn-default btn-lg" name="delete" value="Delete">
                                </form>
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

                                                <!--<button class="btn btn-primary" type="submit">Post Comment</button>-->
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
    <script src="vendor/sweet-alert/sweetalert.min.js"></script>
    <!-- Main File-->
    <script src="js/user/front.js"></script>

    </body>
    </html>

<?php
if (isset($_POST['delete'])) {
    $imgURL = $_SESSION['ImageUrl'];
    $image = new Image();
if ($image) {
    ?>
<script>swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this image file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
   <?php $image->deleteImage($imgURL); ?>
    swal("Your image has been deleted!", {
      icon: "success",
    })
    .then((value) => {
          window.location.href = "user.gallery.php";
        });
  } 
});
</script>

    <?php
   /* if ($image) {
        echo "<script>
        swal(\"Deleted.\", \"Drawing has been deleted\", \"info\")
        .then((value) => {
          window.location.href = \"user.gallery.php\";
        });
        </script>";
   */
    }
}
?>