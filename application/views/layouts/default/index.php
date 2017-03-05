<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ежедневник | Преподаватель</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php echo $header; ?>
</head>
<body class="hold-transition skin-blue layout-top-nav">

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

<div class="wrapper">
	<header class="main-header">
		<nav class="navbar navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<a href="<?php echo site_url('editor/showTimetableForView'); ?>" class="navbar-brand"><b>Ежедневник</b></a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
						<i class="fa fa-bars"></i>
					</button>
				</div>
				<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="<?php echo site_url('editor/showTimetableForView'); ?>">Расписание</a></li>
						<li><a href="<?php echo site_url('editor/showTimetableForEdit'); ?>">Редактировать расписание</a></li>
						<li><a href="<?php echo site_url('editor/ShowTestView'); ?>">Тестовое</a></li>
					</ul>
				</div>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li><a href="<?php echo site_url('auth/logout'); ?>">Выход</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<div class="content-wrapper">
		<div class="container">
			<section id="content" class="content">
				<?php echo $content; ?>
			</section>
		</div>
	</div>
	<footer class="main-footer">
		<div class="container">
			<div class="pull-right hidden-xs">
				<b>Version</b> 1.0.0
			</div>
			<strong>BRU</strong>
		</div>
		<?php echo $footer; ?>
	</footer>
</div>
</body>
</html>