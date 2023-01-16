<?php

include "db.php";
session_start();
if (isset($_SESSION["uid"])) {
    header("location:profile.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ecommerce</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <script src="js/jquery2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="main.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style></style>
</head>
<body>
<div class="wait overlay">
    <div class="loader"></div>
</div>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse"
                    aria-expanded="false">
                <span class="sr-only">navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand">Emart</a>
        </div>
        <div class="collapse navbar-collapse" id="collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li><a href="index.php"><span class="glyphicon glyphicon-modal-window"></span> Products</a></li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" id="search">
                </div>
                <button type="submit" class="btn btn-primary" id="search_btn"><span
                            class="glyphicon glyphicon-search"></span></button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                                class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge">0</span></a>
                    <div class="dropdown-menu" style="width:400px;">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-3">Sl.No</div>
                                    <div class="col-md-3">Product Image</div>
                                    <div class="col-md-3">Product Name</div>
                                    <div class="col-md-3">Price in <?php echo CURRENCY; ?></div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div id="cart_product">
                                  
                                </div>
                            </div>
                            <div class="panel-footer"></div>
                        </div>
                    </div>
                </li>
                <li><a href="/ecommerce-app-h/login_form.php" class="dropdown-toggle" ><span
                                class="glyphicon glyphicon-user"></span> Login/Register</a>
                    <ul class="dropdown-menu">
                        <div style="width:300px;">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Login</div>
                                <div class="panel-heading">
                                    <form onsubmit="return false" id="login">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" required/>
                                        <label for="email">Password</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                               required/>
                                        <p><br/></p>
                                        <input type="submit" class="btn btn-warning" value="Login">
                                        <a href="customer_registration.php?register=1"
                                           style="color:white; text-decoration:none;">Create Account Now</a>
                                    </form>
                                </div>
                                <div class="panel-footer" id="e_msg"></div>
                            </div>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<p><br/></p>
<p><br/></p>
<p><br/></p>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-2 col-xs-12">
            <div id="get_category">
                <div class='nav nav-pills nav-stacked'>
                    <li class='active'><a href='#'><h4>Product Categories</h4></a></li>
                    <?php
                    $category_query = "SELECT * FROM categories";
                    $run_query = mysqli_query($con, $category_query);
                    if (mysqli_num_rows($run_query) > 0) {
                        while ($row = mysqli_fetch_array($run_query)) {
                            $cid = $row["cat_id"];
                            $cat_name = $row["cat_title"];
                            echo "
					<li><a href='#' class='category' cid='$cid'>$cat_name</a></li>
			";
                        }
                        echo "</div>";
                    }
                    ?>
                   
                </div>
                
                <div id="get_brand">
                    <div class='nav nav-pills nav-stacked'>
                        <li class='active'><a href='#'><h4>Brands</h4></a></li>
                    <?php
                    $brand_query = "SELECT * FROM brands";
                    $run_query = mysqli_query($con, $brand_query);


                    if (mysqli_num_rows($run_query) > 0) {
                        while ($row = mysqli_fetch_array($run_query)) {
                            $bid = $row["brand_id"];
                            $brand_name = $row["brand_title"];
                            echo "
					<li><a href='#' class='selectBrand' bid='$bid'>$brand_name</a></li>
			";
                        }
                        echo "</div>";
                    }
                    ?>
                </div>
              
            </div>
            <div class="col-md-8 col-xs-12">
                <div class="row">
                    <div class="col-md-12 col-xs-12" id="product_msg">
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">Products</div>
                    <div class="panel-body">
                        <div id="get_product">
                            <!--Here we get product jquery Ajax Request-->
                        </div>
                       
                    </div>
                    <div class="panel-footer">&copy; <?php echo date(" Y / M / d "); ?></div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</body>
</html>
















































