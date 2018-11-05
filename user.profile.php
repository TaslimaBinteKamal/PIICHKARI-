<?php 
require('db.php');
include 'class/User.php';
include("auth.php");
include ("getInfo.php");
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
	<script src="js/PasswordCheck.js"></script>
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
                        <div class="brand-text brand-small"><strong>Logo</strong></div></a>
                        <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                    </div>
                    <!-- Navbar Menu -->
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <li class="nav-item"><a href="logout.php" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
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
				if($role_id==2){
					echo '<li><a href="user.home.php"><i class="icon-home"></i>Home </a></li>';
				}
				else
					echo '<li ><a href="admin.home.php"><i class="icon-home"></i>Home </a></li>';
			?>
                <li><a href="user.gallery.php"><i class="icon-grid"></i>Gallery</a></li>
                <li><a href="user.canvas.php"><i class="icon-picture"></i>Canvas</a></li>
                <li class="active"><a href="user.profile.php"><i class="icon-interface-windows"></i>Profile</a></li>
            </ul>
        </nav>
        <div class="content-inner">
            <!-- Page Header-->
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">Profile</h2>
                </div>
            </header>
            <!-- Forms Section-->
            <section class="forms">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-6">
                            <!-- Name-->
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h3 class="h4">Name</h3>
                                </div>
                                <div class="card-body">
                                    <form  method="post">
                                        <div class="form-group">
                                            <label class="form-control-label">Enter Name</label>
                                            <input type="text"  name="name" placeholder="<?php echo $userName?>" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Enter Password</label>
                                            <input type="password" name="checkPassword" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Update" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Delete Account-->
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h3 class="h4">Deactivate Account</h3>
                                </div>
                                <div class="card-body">
                                    <form name="deletePassword" method="post">
                                        <div class="form-group">
                                            <label class="form-control-label">Enter Password</label>
                                            <input type="password" name="passwordToDel" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Deactivate" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Password-->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header d-flex align-items-center">
                                    <h3 class="h4">Password</h3>
                                </div>
                                <div class="card-body">
                                    <p>Do you want to change your passsword?</p>
                                    <form name="passwordChange" method="post" onSubmit="return checkPasswordModification()">
                                        <div class="form-group">
                                            <label class="form-control-label">Enter Old Password</label>
                                            <input type="password" name="oldpass" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Enter New Password</label>
                                            <input type="password" name="newpassword1" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Confirm New Password</label>
                                            <input type="password" name="newpassword2" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Update" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
<script src="vendor/popper.js/umd/popper.min.js"> </script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
<script src="vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="js/authentication.js"></script>
<script src="js/sweetalert.min.js"></script>
<!-- Main File-->
<script src="js/user/front.js"></script>

</body>
</html>
<script type="text/javascript">
    function CheckPassword(password1,password2){
    
    var password1Len = password1.value.length;
    var password2Len = password2.value.length;
    if (password1Len < 8 || password1Len > 16)
    {
         swal("Error","Password should not be empty / length be minimum 8 characters and maximum 16 characters","error");
        password1.focus();
        return false;
    }
    if (password2.value != password1.value)
    {
         swal("Error","password doesn't match","error");
        password2.focus();
        return false;
    }
    return true; 
}
    function checkPasswordModification(){
    
    var password1 = document.passwordChange.newpassword1;
    var password2 = document.passwordChange.newpassword2;

    if(CheckPassword(password1,password2)){
        return true;
    }
    return false;
}
</script>

<?php

if (isset($_POST['name'])){
    $name = stripslashes($_REQUEST['name']);
    //escapes special characters in a string
    $name = mysqli_real_escape_string($con, $name);
    $checkPassword = stripslashes($_REQUEST['checkPassword']);
    //escapes special characters in a string
    $checkPassword = mysqli_real_escape_string($con, $checkPassword);
    $email_address = $_SESSION['email'];
    $user = new User();
    //$email_address = $user->getEmail();
    if($user->checkOldpassword($checkPassword,$user_id)==TRUE){
        if($user->changeName($checkPassword, $name, $email_address)){
            echo "<script>swal(\"UPDATED\",\"Record updated successfully\",\"success\");
             </script>";
            //header('Location: user.profile.php');
        }
        else{
            echo "<script>swal(\"ERROR\",\"Record cannot be updated\",\"error\");
            </script>";
        }
         
    } else{
            echo "<script>swal(\"ERROR\",\"Wrong password\",\"error\");
            </script>";
        }

       echo "<script type='text/javascript'>

            (function()
                {
                  if( window.localStorage )
                  {
                    if( !localStorage.getItem( 'firstLoad' ) )
                    {
                      localStorage[ 'firstLoad' ] = true;
                      window.location.reload();
                    }  

                    else
                      localStorage.removeItem( 'firstLoad' );
                  }
                })();
                </script>";
    //echo "<script> window.location.reload(); </script>";
}
if (isset($_POST['oldpass'])){
    
    $oldpass = stripslashes($_REQUEST['oldpass']);
    $oldpass = mysqli_real_escape_string($con, $oldpass);
    $newpassword2 = stripslashes($_REQUEST['newpassword2']);
    $newpassword2 = mysqli_real_escape_string($con, $newpassword2);
    $email_address = $_SESSION['email'];
    $user = new User();
    //$email_address = $user->getEmail();
    if($user->checkOldpassword($oldpass,$user_id)==TRUE){
        if($user->changePassword($newpassword2, $oldpass, $email_address)==TRUE){
            echo "<script>swal(\"UPDATED\",\"password updated successfully\",\"success\");
             </script>";
        }
        else{
            echo "<script>swal(\"ERROR\",\"password cannot be updated\",\"error\");
            </script>";
        }
    } else{
            echo "<script>swal(\"ERROR\",\"Wrong password\",\"error\");
            </script>";
        }
    /* echo "<script type='text/javascript'>

            (function()
                {
                  if( window.localStorage )
                  {
                    if( !localStorage.getItem( 'firstLoad' ) )
                    {
                      localStorage[ 'firstLoad' ] = true;
                      window.location.reload();
                    }  

                    else
                      localStorage.removeItem( 'firstLoad' );
                  }
                })();
                </script>";*/
}
if (isset($_POST['passwordToDel'])){
    
    $passwordToDel = stripslashes($_REQUEST['passwordToDel']);
    $passwordToDel = mysqli_real_escape_string($con, $passwordToDel);
    $email_address = $_SESSION['email'];
    $user = new User();
    //$email_address = $user->getEmail();
    if($user->checkOldpassword($passwordToDel,$user_id)){
       if($user->deleteAccount($passwordToDel, $email_address)){
            echo "<script>
                var url = \"logout.php\";
                window.location = url;
                window.location.replace (url);</script>";
            //header("Location: logout.php");

       }
       else{
         echo "<script>swal(\"Oh no\",\"Couldn't deactivate account\",\"error\");</script>";
       }

    }
    else{
            echo "<script>swal(\"ERROR\",\"Wrong password\",\"error\");
            </script>";
        }

}

?>
