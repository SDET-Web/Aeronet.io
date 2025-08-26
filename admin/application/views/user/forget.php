<html>
	<head>
		<title>Login</title>
		<style>
			html, div, map, dt, isindex, form, header, aside, section, section, article, footer {  
			    display: block;  
			} 
			
			html, body {
			height: 100%;
			margin: 0;
			padding: 0;
			font-family: "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif;
			background: #F8F8F8;
			font-size: 12px;
			}
			
			.clear {
			clear: both;
			}
			
			.spacer {
			height: 20px;
			}
			
			a:link, a:visited {
			color: #77BACE;
			text-decoration: none;
			}
			
			a:hover {
			text-decoration: underline;
			}

		</style>
		<style type="text/css">
		
	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration:none;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 40px 0 40px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
		width:400px;margin:10px auto;
	}
	.form .form_ele_radio{margin-left:-30px;}
	.form .form_ele_radio,.form .form_ele{margin-bottom:10px;}
	.form .form_ele_radio,.form .form_ele label{font-weight:normal;display:block;}
	.form_ele_radio label{display:block;float:left;}
	.form_ele_radio label span{font-weight:normal;}
	.form_ele_radio input{float:left;margin-right:10px;}
	.form .form_ele textarea{width:400px;height:150px;}
	.form .form_button{margin-top:10px;}
	.textfieldsmall,.input,input[type="text"]{width: 250px;font-size: 12px;padding: 5px;border: 1px solid #ccc;}
	select{padding: 5px;font-size: 12px;width: 261px!important;}
	.form .required label{font-weight:bold;}
	.form .error label{color: #900;}
	.form .error input,form .error select{border:1px solid #900;color:#900;}
	.form .help-block{padding: 0px;margin: 2px 0px;}
	.form .help-block span{background: #900;border: 1px solid #600;color: #fff;border-radius: 5px;-moz-border-radius: 5px;padding: 1px 5px;}
	.clear{clear:both;}
	.space{padding:0.5%}
	.left{float:left;}
	.right{float:right;}
	.hidden{display:none;}
	.no-margin-left{margin-left:0px!important;}
	.menu{float:right;margin-top: -24px;}
	.menu li{position: relative;float:left;list-style-type:none;}
	.menu li a{font-size:12px;padding:5px 20px;text-decoration:none;font-weight:bold;}
	.menu li .submenu{display:none;width:150px;left:-20px;position:absolute;border:1px solid #eee;top:20px;border-radius:5px;-moz-border-radius:5px;box-shadow:0px 0px 3px #555;padding:0px;background:#fff;}
	.menu li .submenu a{padding:5px;float:none;}
	.menu li:hover .submenu{display:block;}
	.error_msg { background:#f8dbdd;border:1px dotted #E17984;color:#E17984;padding: 10px;margin: 10px 0px;font-size: 11px; }
	.error_msg p{padding:0px;margin:0px;}
	.success_msg { border: 1px solid #77AB13;color: #286603;background-color: #D9E6C3;padding: 10px; margin: 10px 0px;}

	</style>
	</head>
	<body>
		<div style="font-size:40px;text-align:center;margin-top:100px">TimeForAWash</div>
				<div style="text-align:center"><?php echo $success_msg.$error_msg; ?></div>
<div id="container">
			<h1 id="mhead">Recover Password</h1>
		<div id="body">
			
		 	<div>
			 
      	<span class="headingTdFormat" style="display: none;">Login</span>
<form class="form" method="post" id="loginMemeber" novalidate="novalidate">
							<input type="hidden" name="action" value="login">
							<div class="form">
								 				 				<div class="form_ele control-group required">
					<label>Email</label>
					<div class="controls">
						<input type="text" name="userEmail" id="userEmail" value="" class="input" placeholder="">
											</div>
				</div>
									<div class="form_button">
									<input type="submit" value="Submit">
								</div>
								<a href="<?php echo site_url('user'); ?>">Login</a>
							</div>
						</form>		<div class="clear"></div>
		</div>
				<div class="clear"></div>

		</div>
		<div class="clear"></div>
	<p class="footer">Copyrights TimeForAWash <?php echo date('Y'); ?></p>
</div>
		
	</body>
</html>