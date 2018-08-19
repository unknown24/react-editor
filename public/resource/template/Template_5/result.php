<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">

	<title>Web Builder Template</title>

	<link rel="shortcut icon" href="assets/images/favicon.png">

	<!-- Bootstrap -->
	<link href="assets/css/bootstrap.no-icons.min.css" rel="stylesheet">
	<!-- Icons -->
	<link href="assets/css/font-awesome.css" rel="stylesheet">
	<!-- Fonts -->
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- Custom styles -->
	<link rel="stylesheet" href="assets/css/styles.css">

	<!--[if lt IE 9]> <script src="assets/js/html5shiv.js"></script> <![endif]-->
</head>
<body>

<header id="header">
	<div id="head" class="parallax qw-section" parallax-speed="2">
		<h1 id="logo" class="text-center" style="color: white;">
			<span class="title">Detail Transaction</span>
			<span class="tagline">Example Tagline<br>
				<a href="#">example.blabla@example.com</a></span>
		</h1>
	</div>
	<nav class="navbar navbar-default navbar-sticky" style="margin-bottom: 0px">
		<div class="container-fluid">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
			</div>

			<div class="navbar-collapse collapse">

				<ul class="nav navbar-nav qw-list-item">
					<li><a href="index.html">Home</a></li>
					<li><a href="profile.html">Profile</a></li>
					<li><a href="contact.html">Contact</a></li>
					<li><a href="product.html">Product</a></li>
					<li><a href="gallery.html">Gallery</a></li>
					<li class="qw-list-default"><a href="default.html">Default</a></li>
					<li class="dropdown active">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-account>Account<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="sign-up.html">Sign Up</a></li>
							<li><a href="login.html">Login</a></li>
						</ul>
					</li>
					<li class="dropdown active">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-login>My Account<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="account.html">My Account</a></li>
							<li><a href="change-pass.html">Change Password</a></li>
							<li><a href="address-book.html">Address Book</a></li>
							<li><a href="view-cart.html">List Cart</a></li>
							<li><a href="whistlist.html">Whist List</a></li>
							<li><a href="order-history.html">Order History</a></li>
							<li><a href="rewards-points.html">Rewards Points</a></li>
							<li><a href="transactions.html">Transactions</a></li>
						</ul>
					</li>
				</ul>

			</div><!--/.nav-collapse -->
		</div>
	</nav>
</header>


<main id="main">

	<section class="row topspace" id="contact-map">
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
		<div class="container" id="form-sign-up">
			<div class="col-sm-12" id="add"></div>
			<div class="alert alert-success" style="text-align: center;">
                    <h4><strong>Success!</strong> Order successful.</h4>
                </div>
                <table class="display redTable" border="1" width="100%">
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
                <table class="display redTable" border="1" width="100%">
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
		<?php } ?>
	</section>

</main>

<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-3 widget">
				<h3 class="widget-title">Contact</h3>
				<div class="widget-body">
					<p>+622152905148<br>
						<a href="mailto:#">example.blabla@example.com</a><br>
						<br>
						Jl. Coblong Selatan Bandung
					</p>
				</div>
			</div>

			<div class="col-md-3 widget">
				<h3 class="widget-title">Follow me</h3>
				<div class="widget-body">
					<p class="follow-me-icons">
						<a href="#"><i class="fa fa-twitter fa-2"></i></a>
						<a href="#"><i class="fa fa-dribbble fa-2"></i></a>
						<a href="#"><i class="fa fa-github fa-2"></i></a>
						<a href="#"><i class="fa fa-facebook fa-2"></i></a>
					</p>
				</div>
			</div>

			<div class="col-md-3 widget">
				<h3 class="widget-title">Text widget</h3>
				<div class="widget-body">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, nihil natus explicabo ipsum quia iste aliquid repellat eveniet velit ipsa sunt libero sed aperiam id soluta officia asperiores adipisci maxime!</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, nihil natus explicabo ipsum quia iste aliquid repellat eveniet velit ipsa sunt libero sed aperiam id soluta officia asperiores adipisci maxime!</p>
				</div>
			</div>

			<div class="col-md-3 widget">
				<h3 class="widget-title">Form widget</h3>
				<div class="widget-body">
					<p>+622152905148<br>
						<a href="mailto:#">example.blabla@example.com</a><br>
						<br>
						Jl. Coblong Selatan Bandung
					</p>
				</div>
			</div>

		</div> <!-- /row of widgets -->
	</div>
	<div class="container">
		<div class="row">

			<div class="col-md-6 widget">
				<div class="widget-body">
					<p>BDG JUARA </p>
				</div>
			</div>

			<div class="col-md-6 widget">
				<div class="widget-body">
					<p class="text-right">
						Copyright &copy; 2017, Web Builder Template<br>
						Design: <a href="#" rel="designer">Web Builder Template</a> </p>
				</div>
			</div>

		</div> <!-- /row of widgets -->
	</div>
</footer>
<a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="fa fa-arrow-up"></span></a>

<!-- JavaScript libs are placed at the end of the document so the pages load faster -->

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/template.js"></script>

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