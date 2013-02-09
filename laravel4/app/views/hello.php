<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>meetPHP#8 - laravel4</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Aplikacja testowa na meetphp! ">
		<meta name="author" content="mmx3.pl">
		<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="/public/css/bootstrap.min.css" rel="stylesheet" />
		<link href="/public/css/bootstrap-responsive.min.css" rel="stylesheet" 	/>
		<script type="text/javascript">var switchTo5x=true;</script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="/public/js/bootstrap.min.js"></script>
	</head>
	<body class="preview" data-spy="scroll" data-target=".subnav" data-offset="80">
		
			<header class="jumbotron subhead" id="overview">
				<div class="container">
					<div class="row">
						<div class="span6">
							<h1>meet.php#8 - laravel4</h1>
							<p class="lead">Hello meetphp!</p>
						</div>
					</div>
				</div>
			</header>
		
		<section id="content">
			<div class="container">
				<div class="row">
					<div class="span7">
					    	<table>
                        		<thead>
                        			<tr><th>id</th><th>name</th><th>content</th></tr>
                        		</thead>
                        		<tbody>
                        			<?php foreach($posts as $post): ?>
                        			
                        			<tr><td><?php echo $post->id; ?></td><td><?php echo $post->name; ?></td><td><?php echo $post->content; ?></td></tr>
                        			<?php endforeach;?>
                        		</tbody>
                        	</table>
					</div>
				</div>
			</div>
		</section>
		
		<footer class="footer">
			<div class="container">
				<p class="pull-right"><a href="#">Back to top</a></p>
			</div>
		</footer>
		<a href="https://github.com/emgiezet/meetphp-8"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png" alt="Fork me on GitHub"></a>
	</body>
</html>