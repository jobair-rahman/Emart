<?php

if (isset($_SESSION["uid"])) {
	header("location:profile.php");
}

if (isset($_POST["login_user_with_product"])) {
	//this is product list array
	$product_list = $_POST["product_id"];
	//here we are converting array into json format because array cannot be store in cookie
	$json_e = json_encode($product_list);
	//here we are creating cookie and name of cookie is product_list
	setcookie("product_list",$json_e,strtotime("+1 day"),"/","","",TRUE);

}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ecommerce</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/jquery2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="main.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <div class="wait overlay">
        <div class="loader"></div>
    </div>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">Emart</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
                <li><a href="index.php"><span class="glyphicon glyphicon-modal-window"></span>Product</a></li>
            </ul>
        </div>
    </div>




    <div class="main-wrapper">
        <form action="GET" onsubmit="return false" id="login">
            <div class="form-cont-1">
                <h1>Sign In</h1>
                <p>Forgot your password?</p>
            </div>
            <div class="form-cont-2">
                <p>Email address</p>
                <input type="email" class="form-control" name="email" id="email" required />
            </div>
            <div class="form-cont-3">
                <div class="pass-cont">
                    <p>Password</p>
                    <input type="password" class="form-control" name="password" id="password" required />
                </div>
                <input class="check" id="check-text" type="checkbox"></input>
                <label class="check-label" for="check-text">Remember me</label>
            </div>


            <p><br /></p>

            <input type="submit" class="btn btn-success" style="float:right;" Value="Login">

            <div><a href="customer_registration.php?register=1">Create a new account?</a></div>

        </form>
        <div class="float circle c-1"></div>
        <div class="float circle c-2"></div>
        <div class="float circle c-3"></div>
        <div class="float line l-1"></div>
        <div class="float line l-2"></div>
        <div class="float line l-3"></div>
    </div>
    <div class="main-wrapper2">
        <div class="border-line"></div>
    </div>







</body>

</html>