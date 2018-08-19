<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Website Builder Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<header>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <img src="user-image/logo.png">
                <!--button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Logo</a-->
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right qw-list-item">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="profile.html">Profile</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
                    <li>
                        <a href="product.html">Product</a>
                    </li>
                    <li>
                        <a href="gallery.html">Gallery</a>
                    </li>
                    <li>
                        <a href="bonus.html">Bonus</a>
                    </li>
                    <li class="qw-list-default">
                        <a href="default.html">Default</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-account>Account <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="sign-up.html">Sign Up</a>
                            </li>
                            <li>
                                <a href="login.html">Login</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-login>My Account <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="account.html">My Account</a>
                            </li>
                            <li>
                                <a href="change-pass.html">Change Password</a>
                            </li>
                            <li>
                                <a href="address-book.html">Address Book</a>
                            </li>
                            <li>
                                <a href="view-cart.html">List Cart</a>
                            </li>
                            <li>
                                <a href="whistlist.html">Whist List</a>
                            </li>
                            <li>
                                <a href="order-history.html">Order History</a>
                            </li>
                            <li>
                                <a href="rewards-points.html">Rewards Points</a>
                            </li>
                            <li>
                                <a href="transactions.html">Transactions</a>
                            </li>
                            <li>
                                <a href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="view-cart.html">
                            <i class="fa fa-shopping-cart"></i> (<span count-cart>0</span>)
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</header>

    <!-- Page Content -->
    <section id="blog">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Detail Transaction
                    <small>Detail Transaction</small>
                </h2>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Detail Transaction</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

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
        <!-- Blog Post Row -->
        <div class="row" id="add"></div>
        <!-- /.row -->
        <div class="alert alert-success" style="text-align: center;">
                    <h4><strong>Success!</strong> Order successful.</h4>
                </div>
                <table class="display blueTable" border="1" width="100%">
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
                <table class="display blueTable" border="1" width="100%">
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
        <?php } ?>
    </div>
    <!-- /.container -->
    </section>


    <!-- Footer -->
    <footer class="footer-bs">
        <div class="row">
            <div class="col-md-3 footer-brand animated fadeInLeft">
                <img src="user-image/logo.png">
                <p>Suspendisse hendrerit tellus laoreet luctus pharetra. Aliquam porttitor vitae orci nec ultricies. Curabitur vehicula, libero eget faucibus faucibus, purus erat eleifend enim, porta pellentesque ex mi ut sem.</p>
                <p>© 2017 World, All rights reserved</p>
            </div>
            <div class="col-md-3 footer-nav animated fadeInUp">
                <h4>Menu —</h4>
                <ul class="pages">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Profile</a></li>
                     <li><a href="#">Contact</a></li>
                    <li><a href="#">Product</a></li>
                    <li><a href="#">Gallery</a></li>
                </ul>
            </div>
            <div class="col-md-3 footer-social animated fadeInDown">
                <h4>Follow Us</h4>
                <ul>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">RSS</a></li>
                </ul>
            </div>
            <div class="col-md-3 footer-ns animated fadeInRight">
                <h4>Contact</h4>
                <p>
                    3481 Melrose Place<br>Beverly Hills, CA 90210<br>
                </p>
                <p><i class="fa fa-phone"></i> 
                    <abbr title="Phone">P</abbr>: (123) 456-7890</p>
                <p><i class="fa fa-envelope-o"></i> 
                    <abbr title="Email">E</abbr>: <a href="mailto:name@example.com">name@example.com</a>
                </p>
                <p><i class="fa fa-clock-o"></i> 
                    <abbr title="Hours">H</abbr>: Monday - Friday: 9:00 AM to 5:00 PM
                </p>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Wow JS -->
    <script src="js/wow.min.js"></script>

    <!-- Custom JS -->
    <script src="js/costume.js"></script>

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
