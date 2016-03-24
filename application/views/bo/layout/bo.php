<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/bo/bootstrap/css/bootstrap.css') ?>">
		<link rel="stylesheet" href="<?php echo base_url('js/bo/font-awesome/css/font-awesome.css'); ?>">

		<script src="<?php echo base_url('js/bo/jquery-1.11.1.min.js') ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('js/bo/theme.js'); ?>" type="text/javascript"></script>

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bo/theme.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bo/premium.css') ?>">

		<script type="text/javascript">
			var baseURL = "<?php echo base_url(); ?>";
		</script>
		
		<!-- Load WysiBB JS and Theme -->
		<script src="<?php echo base_url('js/wysibb/jquery.wysibb.min.js'); ?>"></script>
		<link rel="stylesheet" href="<?php echo base_url('css/wysibb/theme/wbbtheme.css'); ?>" type="text/css" />
		<?php echo $css_for_layout ?>

		<?php echo $js_for_layout ?>

        <title><?php echo $title_for_layout ?></title>
    </head>
	<body class=" theme-blue">


		<!-- Demo page code -->

		<script type="text/javascript">
			$(function () {
				var match = document.cookie.match(new RegExp('color=([^;]+)'));
				if (match)
					var color = match[1];
				if (color) {
					$('body').removeClass(function (index, css) {
						return (css.match(/\btheme-\S+/g) || []).join(' ')
					})
					$('body').addClass('theme-' + color);
				}

				$('[data-popover="true"]').popover({html: true});

			});
		</script>
		<style type="text/css">
			#line-chart {
				height:300px;
				width:800px;
				margin: 0px auto;
				margin-top: 1em;
			}
			.navbar-default .navbar-brand, .navbar-default .navbar-brand:hover { 
				color: #fff;
			}
		</style>

		<script type="text/javascript">
			$(function () {
				var uls = $('.sidebar-nav > ul > *').clone();
				uls.addClass('visible-xs');
				$('#main-menu').append(uls.clone());
			});
		</script>

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="../assets/ico/favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">


		<!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
		<!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
		<!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
		<!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
		<!--[if (gt IE 9)|!(IE)]><!--> 

		<!--<![endif]-->

		<div class="navbar navbar-default" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="" href="<?php echo base_url('bo'); ?>"><span class="navbar-brand"><span class="fa fa-rss"></span> My rest</span></a></div>

			<div class="navbar-collapse collapse" style="height: 1px;">
				<ul id="main-menu" class="nav navbar-nav navbar-right">
					<li class="dropdown hidden-xs">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> 
							<?php if (!$user->name || !$user->forname): ?>
								<?php echo $user->login; ?>
							<?php else: ?>
								<?php echo $user->name; ?> <?php echo $user->forname; ?>
							<?php endif; ?>
							<i class="fa fa-caret-down"></i>
						</a>

						<ul class="dropdown-menu">
							<li><a href="./">Mon compte</a></li>
							<li class="divider"></li>
							
							<li><a tabindex="-1" href="<?php echo base_url('bo/logout') ?>">Se déconnecter</a></li>
						</ul>
					</li>
				</ul>

			</div>
		</div>


		<div class="sidebar-nav">
			<ul>
				<li><a href="#" data-target=".dashboard-menu" class="nav-header" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i> Dashboard<i class="fa fa-collapse"></i></a></li>
				<li><ul class="dashboard-menu nav nav-list collapse in">
						<li><a href="<?php echo base_url('bo/home') ?>"><span class="fa fa-caret-right"></span> Main</a></li>
						<li ><a href="<?php echo base_url('bo/users') ?>"><span class="fa fa-caret-right"></span> Liste des utilisateurs</a></li>
						<li ><a href="<?php echo base_url('bo/administrators') ?>"><span class="fa fa-caret-right"></span> Liste des administrateurs</a></li>
					</ul></li>

				<li><a href="#" data-target=".tuto-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-graduation-cap"></i> Tutoriels<i class="fa fa-collapse"></i></a></li>
				<li><ul class="tuto-menu nav nav-list collapse">
						<li ><a href="<?php echo base_url('bo/tutorials/all'); ?>"><span class="fa fa-caret-right"></span> Tous les tutoriels</a></li>
						<li ><a href="<?php echo base_url('bo/tutorials/new'); ?>"><span class="fa fa-caret-right"></span> créer un nouveau tutoriel</a></li>
					</ul></li>

				
			</ul>
		</div>

		<div class="content">
			<div class="header">
<!--				<div class="stats">
					<p class="stat"><span class="label label-info">5</span> Tickets</p>
					<p class="stat"><span class="label label-success">27</span> Tasks</p>
					<p class="stat"><span class="label label-danger">15</span> Overdue</p>
				</div>-->

				<h1 class="page-title">Dashboard</h1>
				<ul class="breadcrumb">
					<?php foreach ($breadcrumb as $segment => $uri) : ?>
						<li><a href="<?php echo $uri ?>"><?php echo $segment ?></a> </li>
					<?php endforeach; ?>
				</ul>

			</div>
			<div class="main-content">
				<?php if (isset($errors)): ?>
				<div class="alert alert-error">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<h4>Error!</h4>
					<?php foreach ($errors as $error): ?>
						<?php echo $error; ?>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
				<?php if (isset($warnings)): ?>
					<div class="alert alert-block">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<h4>Warning!</h4>
						<?php foreach ($warnings as $warning): ?>
							<?php echo $warning; ?>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<?php if (isset($success)): ?>
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Success!</h4>
						<?php foreach ($success as $succes): ?>
							<?php echo $succes; ?>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<?php echo $content_for_layout ?>

				<div id="modal-from-dom" class="modal small fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<a href="#" class="close" data-dismiss="modal">&times;</a>
								<h3></h3>
							</div>
							<div class="modal-body">

							</div>
							<div class="modal-footer">
								<a href="" class="btn btn-danger">OK</a>
								<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					$(function () {

						$('.confirm').click(function (e) {
							var url = $(this).data('url');
							var body = $(this).data('body');
							var header = $(this).data('header');
							var $modal = $('#modal-from-dom');
							$modal.modal('show');
							var $removeBtn = $modal.find('.btn-danger');
							$removeBtn.attr('href', url);

							var $body = $modal.find(".modal-body");
							$body.html(body);
							
							var $header = $modal.find(".modal-header h3");
							$header.html(header);

						});
					});
				</script>
				<footer>
					<hr>

					<!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
					<p>© 2015 <a href="#" target="_blank">Core</a></p>
				</footer>
			</div>
		</div>

		<?php echo Modules::run('flashmessages/flashMessages/slidedownstyle'); ?>
		<script src="<?php echo base_url('js/bo/bootstrap/js/bootstrap.js') ?>"></script>
		<script type="text/javascript">
					$("[rel=tooltip]").tooltip();
					$(function () {
						$('.demo-cancel-click').click(function () {
							return false;
						});
					});
		</script>


	</body></html>
