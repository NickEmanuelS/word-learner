<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<head>
	<?php
		echo $this->fetch('meta');
		echo $this->Html->meta('app/webroot/favicon.ico', 'favicon.ico', array('type' => 'icon'));
		echo $this->Html->meta('width=device-width, initial-scale=1.0', array('type' => 'viewport'));
		echo $this->Html->meta('Word Learner', array('type' => 'description'));
		echo $this->Html->meta('K Web Systems', array('type' => 'author'));
	?>
	<title>
		<?php echo "Word Learner :: ".$this->fetch('title'); ?>
	</title>
	
	<link href='http://fonts.googleapis.com/css?family=Exo:100,200,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300' rel='stylesheet' type='text/css'>
	
	<?php
		echo $this->Html->css('custom.css');
		//USUÁRIO DA SESSÃO
		$usuario_sessao = $this->Session->read('Auth.User');
	?>
</head>
<style>
body{
	margin: 0;
	padding: 0;
	background: #fff;

	color: #fff;
	font-family: Arial;
	font-size: 12px;
	overflow: hidden;
}

.body{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	background-color: #f6ba01;
	width: auto;
	height: auto;
	background-size: cover;
	-webkit-filter: blur(5px);
	z-index: 0;
}

.grad{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
	z-index: 1;
	opacity: 0.7;
}

.header{
	position: absolute;
	top: calc(26% - 35px);
	left: calc(35% - 255px);
	z-index: 2;
}

.header div{
	float: left;
	color: #fff;
	font-family: Arial;
	font-size: 35px;
	font-weight: 200;
}

.header div span{
	color: #5379fa !important;
}

.login{
	position: absolute;
	top: calc(50% - 75px);
	left: calc(50% - 50px);
	height: 150px;
	width: 350px;
	padding: 10px;
	z-index: 2;
}

.login input[type=text]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: Arial;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
}

.login input[type=password]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: Arial;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
	margin-top: 10px;
}

.login input[type=text]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=password]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

::-webkit-input-placeholder{
   color: rgba(255,255,255,0.6);
}

::-moz-input-placeholder{
   color: rgba(255,255,255,0.6);
}
</style>
<body>
<div class="body"></div>
<div class="grad"></div>
<div class="header">
	<img src="../img/logo_wl_white.png" width="60%" />
</div>
<br>
<div class="login">
	<?php
		$message = $this->Session->flash();
		if($message){
			echo $message;
		}
		
		echo $this->fetch('content');
	?>
</div>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	
</body>
</html>