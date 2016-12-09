<!DOCTYPE html>
<?php
	include "component/koneksi.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<meta name="viewport" content="initial-scale=1.0" />-->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Perencanaan Penempatan Toko Modern di Semarang</title>
<link rel="stylesheet" href="css/style.default.css" type="text/css" />
<link rel="stylesheet" href="css/style.shinyblue.css" type="text/css" />

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="js/modernizr.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#login').submit(function(){
            var u = jQuery('#username').val();
            var p = jQuery('#password').val();
            if(u == '' && p == '') {
                jQuery('.login-alert').fadeIn();
                return false;
            }
        });
    });
</script>
</head>

<body class="loginpage">

<div class="loginpanel" >
    <div class="loginpanelinner">
        <!--<div class="logo animate0 bounceIn"><img src="images/logo.png" alt="" /></div>-->
		<!--<div class="logo animate0 bounceIn"><img src="images/disperindag.png" style="width:270px; margin-top:-100px;" alt="" /></div> ENAKNYA DIKASIH APA GAK?-->
        <div class="logo animate0 bounceIn"><img src="images/logo2.png" style="width:270px; height:37px" alt="" /></div>
		<!--<div class="logo animate0 bounceIn"><img src="images/logo.png" style='width:35% !important' alt="" /></div>-->
        <form id="login" action="proses_login.php" method="post">
            <div class="inputwrapper login-alert">
                <div class="alert alert-error">Invalid username or password</div>
            </div>
            <div class="inputwrapper animate1 bounceIn">
                <input type="text" style="margin-left:0%" name="username" id="username" placeholder="Enter any username" />
            </div>
            <div class="inputwrapper animate2 bounceIn">
                <input type="password" style="margin-left:0%" name="password" id="password" placeholder="Enter any password" />
            </div>
            <div class="inputwrapper animate3 bounceIn">
                <button name="submit" style="margin-left:0%">Sign In</button>
            </div>
            <div class="inputwrapper animate4 bounceIn" style="margin-left:0%">
                <label><input type="checkbox" style="margin-left:0%" class="remember" name="signin" /> Keep me sign in</label>
            </div>
            <div class="inputwrapper animate4 bounceIn" style="margin-left:33.33%">
            <!--<div class="inputwrapper animate4 bounceIn" style="margin-center">-->
                <label><a  style="color:white !important" href="home.php"> Kembali ke HOME</a></label>
            </div>
            
        </form>
    </div><!--loginpanelinner-->
</div><!--loginpanel-->

<div class="loginfooter">
    <p>&copy; 2015. Shamcey Admin Template. All Rights Reserved.</p>
</div>

</body>
</html>
