<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Registrate</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

	<?php
	echo link_tag('assets/css/bootstrap.min.css');
	echo link_tag('assets/css/AdminLTE.min.css');
	echo link_tag('assets//plugins/iCheck/square/blue.css');
	?>
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js" ></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js" ></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js" ></script>
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		<a><b>Дневник</b></a>
	</div>
	<div class="login-box-body">
		<p class="login-box-msg">Регистрация</p>
		<form action="<?php echo site_url('auth/register/'); ?>" method="post">
			<div class="form-group has-feedback">
				<input name="login" type="text" class="form-control" placeholder="Логин">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input name="password" type="password" class="form-control" placeholder="Пароль">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input name="password-repeated" type="password" class="form-control" placeholder="Повторите пароль">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-4">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Создать</button>
				</div>
			</div>
		</form>
		<br/>
		<a href="<?php echo site_url('auth'); ?>">Уже есть аккаунт</a>
	</div>
</div>
</body>
</html>
