<!DOCTYPE html>
<html lang="en">

<head>
    <!-- METAS -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- TITLE -->
    <title>Builder Template</title>

    <!-- FAVICON -->
    <link rel="shortcut icon" href="images/favicon.png"/>

    <!-- LOAD MAIN CSS -->
    <link href="css/style.css" rel="stylesheet" type="text/css">

    <!-- LOAD COLOR STYLE (OPTONAL) CSS -->
    <link href="css/lunar.css" rel="stylesheet" type="text/css" id="colorstyle">

    <!-- LOAD CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet" type="text/css">

</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader">
        <i class="fa fa-spinner fa-spin preloader-animation" aria-hidden="true"></i>
    </div>
    <!-- Preloader End -->
    
    
        <!-- HEADER START -->
        <!--section id="header"-->
        <!-- Fixed navbar -->
    <header>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="images/logo.png" alt="Edura - Multipurpose Website Template">
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav qw-list-item">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="product.html">Product</a></li>
                        <li><a href="gallery.html">Gallery</a></li>
                        <li><a href="bonus.html">Bonus</a></li>
                        <li class="qw-list-default"><a href="default.html">Default</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-account>Account</a>
                            <ul class="dropdown-menu">
                                <li><a href="sign-up.html">Sign Up</a></li>
                                <li><a href="login.html">Login</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-login>My Account <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="account.html">My Account</a></li>
                                <li><a href="change-pass.html">Change Password</a></li>
                                <li><a href="address-book.html">Address Book</a></li>
                                <li><a href="view-cart.html">List Cart</a></li>
                                <li><a href="whistlist.html">Whist List</a></li>
                                <li><a href="order-history.html">Order History</a></li>
                                <li><a href="rewards-points.html">Rewads Points</a></li>
                                <li><a href="transaction.html">Transaction</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                        <li><a href="view-cart.html"><i class="fa fa-shopping-cart"></i> (<span count-cart>0</span>)</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
    </header>
        <!--/section-->
        <!-- HEADER END -->

    <!-- WRAPPER START -->
    <div id="wrapper">
        <!-- PAGE TITLE START -->
        <section id="title" class="container-fluid wow fadeInDown">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                        <h1>Detail Transaction</h1>
                    </div>
                    <div class="col-xs-6 text-right breadcrumbs">
                        <ul class="list-inline list-unstyled">
                            <li><a href="index.html">Home</a></li>
                            <li>/</li>
                            <li>Transaction</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- PAGE TITLE END -->

        <?php
        $data = file_get_contents("scid.txt");
        $data = json_decode($data, true);

        //update status
        $link = mysqli_connect("localhost", "buildweb_".$data['db']['dbuser'], $data['db']['dbpass'], "buildweb_".$data['db']['dbname']);
        $order = mysqli_query($link,"SELECT * FROM qw_order WHERE order_id='".$_POST['order_number']."'");
        while ($row = $order->fetch_array()){
        
        $sql_update1 = "UPDATE qw_doku SET statustype='".$_POST['msg']."',response_code='".$_POST['responsecode']."',approvalcode='".$_POST['approvalcode']."',trxstatus = 'Success',session_id='".$_POST['session_id']."',verifyid='".$_POST['verify_id']."',verifyscore='".$_POST['verify_score']."',verifystatus='".$_POST['verify_status']."' WHERE transidmerchant ='".$_POST['order_number']."'";
        $sql_update1 = mysqli_query($link,$sql_update1);
        $sql_update2 =  "UPDATE qw_order set order_status_id = 17 WHERE order_id='".$_POST['order_number']."'";
        $sql_update2 = mysqli_query($link,$sql_update2);
        ?>
        <!-- CONTENT START -->
        <section id="sign-up" style="padding-top: 30px">
            <div class="container" id="form-sign-up">
                <div class="row" id="add"></div>
                <div class="alert alert-success" style="text-align: center;">
                    <h4><strong>Success!</strong> Order successful.</h4>
                </div>
                <table class="display darkTable" border="1" width="100%">
                    <thead>
                        <tr><th colspan="2">Order Details</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>No Invoice : <?php echo $row["invoice_prefix"].$row["invoice_no"]; ?></td>
                            <td>Date Added : <?php echo $row["date_added"]; ?></td>
                        </tr>
                        <tr>
                            <td>Order ID : #<?php echo $row["date_added"]; ?></td>
                            <td>Payment Method : <?php echo $row["payment_method"]; ?></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table class="display darkTable" border="1" width="100%">
                    <thead>
                        <tr>
                            <th align="center">No</th>
                            <th align="center">Product Name</th>
                            <th align="center">Model</th>
                            <th align="center">Quantity</th>
                            <th align="center">Price</th>
                            <th align="center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $product = mysqli_query($link,"SELECT * FROM qw_order_product WHERE order_id='".$_POST['order_number']."'");
                        $i=1;
                        while ($r = $product->fetch_array()){
                        ?>
                        <tr>
                            <td align="center"><?php echo $i; ?></td>
                            <td><?php echo $r["name"]; ?></td>
                            <td align="center"><?php echo $r["model"]; ?></td>
                            <td align="center"><?php echo $r["quantity"]; ?></td>
                            <td align="right">Rp <?php echo number_format($r["price"],0,",","."); ?></td>
                            <td align="right">Rp <?php echo number_format($r["total"],0,",","."); ?></td>
                        </tr>
                        <?php $i++;}
                        $total_product = mysqli_query($link,"SELECT * FROM qw_order_total WHERE order_id='".$_POST['order_number']."'");
                        while ($d = $total_product->fetch_array()){
                        ?> 
                        <tr>
                            <td colspan=5 style="text-align:right"><?php echo $d["title"]; ?></td>
                            <td style="text-align:right">Rp <?php echo number_format($d["value"],0,",","."); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br><br>
            </div>
            <div class="space40"></div>
        </section>
        <?php } ?>
        <!-- CONTENT END -->

        <!-- FOOTER START -->
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <img src="images/logo.png" alt="Logo - Web Builder Template"><br><br>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. <b>Lorem ipsum dolor sit amet, consectetur adipiscing</b>.</p>
                        <br>
                        <ul class="list-unstyled list-inline social-icons">
                            <li><a href="#" class="facebook"><i class="fa fa-facebook facebook"></i></a></li>
                            <li><a href="#" class="twitter"><i class="fa fa-twitter twitter"></i></a></li>
                            <li><a href="#" class="googleplus"><i class="fa fa-google-plus googleplus"></i></a></li>
                            <li><a href="#" class="youtube"><i class="fa fa-youtube youtube"></i></a></li>
                            <li><a href="#" class="linkedin"><i class="fa fa-linkedin linkedin"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h4>CONTACT US</h4>
                        <p><i class="fa fa-map-pin fa-fw"></i> Graha Pos Indonesia Lantai 6 C, Jl.Banda no.30, Bandung 40115 -  Indonesia</p>
                        <p><i class="fa fa-phone fa-fw"></i> 0804-1-808-888</p>
                        <p><i class="fa fa-phone fa-fw"></i> +62 21 52905148</p>
                        <p><i class="fa fa-envelope fa-fw"></i> info@qwords.com</p>
                    </div>
                    <div class="col-md-3">
                        <h4>PAGES</h4>
                        <ul class="list-unstyled col-md-6">
                            <li><i class="fa fa-caret-right fa-fw" aria-hidden="true"></i> <a href="#">HOME</a></li>
                            <li><i class="fa fa-caret-right fa-fw" aria-hidden="true"></i> <a href="#">PROFILE</a></li>
                            <li><i class="fa fa-caret-right fa-fw" aria-hidden="true"></i> <a href="#">CONTACT</a></li>
                            <li><i class="fa fa-caret-right fa-fw" aria-hidden="true"></i> <a href="#">PRODUCT</a></li>
                        </ul>
                        <ul class="list-unstyled col-md-6">
                            <li><i class="fa fa-caret-right fa-fw" aria-hidden="true"></i> <a href="#">GALLERY</a></li>
                            <li><i class="fa fa-caret-right fa-fw" aria-hidden="true"></i> <a href="#">BONUS</a></li>
                            <li><i class="fa fa-caret-right fa-fw" aria-hidden="true"></i> <a href="#">OTHER</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h4>NEWSLETTER</h4>
                        <p>Subscribe to our monthly newsletter and stay updated with the latest news and info.</p>
                        <form action="#" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
                                    <input type="email_news" class="form-control" id="email_news" placeholder="Your Email Address" required>
                                </div>
                            </div>
                            <div class="form-group pull-right">
                                <button type="submit" class="btn btn-primary">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <hr>
                    <div class="col-md-12 text-center bottom">
                        <p>Copyright &copy; 2017 Web Builder. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- FOOTER END -->


    </div>
    <!-- WRAPPER END -->

    <!-- back to top button -->
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbo8AqPhlblo2nbndho2I8zLzr0o9Qs28"></script>
    <script type="text/javascript" src="js/gmap.js"></script>

    <!-- MAIN JS FILES REQUIRED ON ALL PAGES -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="vendor/SmoothScroll/SmoothScroll.min.js"></script>

    <script src="vendor/waypoints/waypoints.min.js"></script>
    <script src="vendor/counterup/jquery.counterup.min.js"></script>


    <!-- HERO SLIDER-->
    <script src="vendor/hero-slider/js/modernizr.js"></script>
    <script src="vendor/hero-slider/js/main.js"></script>

    <!-- OWL CAROUSEL -->
    <script src="vendor/owl-carousel/owl.carousel.js"></script>

    <!-- FILTERIZR -->
    <script src="vendor/jquery/jquery.filterizr.js"></script>

    <!-- EDURA JS REQUIRED ON ALL PAGES-->
    <script src="js/edura.js"></script>

    <script>
    $(document).ready(function(){
        jQuery.get('scid.txt', function(value) {
            var obj = JSON.parse(value);
            $.post('getdata.php',function(customer_id){
                if(customer_id){
                    $.post("https://build.web.id/api/customers/getCustomerdatabyId/",{
                        "client_id": obj.cid,
                        "service_id": obj.layanan_id,
                        "customer_id": customer_id
                    },function(data){
                        firstname = data.data.firstname;
                        lastname = data.data.lastname;
                        $('[data-login]').html(firstname+' '+lastname+' <b class="caret"></b>')
                        $('[data-account]').hide()
                    }); 

                    cid = window.atob(obj.cid),
                    sid = window.atob(obj.layanan_id),
                    $.post("https://build.web.id/api/cart/content/",{
                        "client_id": cid,
                        "service_id": sid,
                        "customer_id": customer_id
                    },function(data){
                        $('[count-cart]').text(data.count)
                    });
                }else{
                    $('[data-login]').hide()
                    $('[data-account]').show()
                }
            });
        });
    });
    </script>

</body>
</html>
