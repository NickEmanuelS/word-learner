<?php
	$perfilVisitante = $this-> Session-> read('Auth');
?>

<!-- TOP NAVBAR -->

<style>
	.error-message {
		color:red;
	}
	<!-- Colore as mensagens de erro do Model -->
</style>

<div id="head-nav" class="topbar navbar navbar-default">
	<div class="container-fluid">
	  <div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		  <span class="fa fa-bars"></span>
		</button>
	  </div>
	  <div class="navbar-collapse collapse">
		
		<ul class="nav navbar-nav horizontal">
		
			<li class="dropdown">
				<?php 
					echo $this->Html->link(
											'<i class="fa fa-home"></i>',
											array("controller"=>"users", "action" => "index"),
											array('escape'=>false, "title"=>"Home page")
										); 
				?> 
			</li>
			
			<li class="dropdown">
				<?php echo $this->Html->link(('<strong>Taking notes</strong>'), array('controller'=>'dias', 'action' => 'index'), array('escape'=>false)); ?>
			</li>
			<li class="dropdown">
			<?php
				echo $this->Html->link($this->Html->tag('strong', 'Add day'), array('controller'=>'dias', 'action'=>'add'), array('escape'=>false));
			?>
			</li>
			<?php
				if($perfilVisitante['User']['flg_tipo_usuario'] == 'adm'){
					echo
					'<li class="dropdown">
						'.$this->Html->link(('<strong>Users</strong>'), array('controller' => 'users', 'action'=>'lista'), array('escape'=>false)).'
					</li>';
				}
			?>
		</ul>
		<ul class="nav navbar-nav navbar-right user-nav">
		  <li class="dropdown profile_menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><strong style="font-size: 20px;"; id="data"></strong></a>
		  </li>
		  <li class="dropdown profile_menu">
			<li>
			  <a class="dropdown-toggle">User: <strong><?= $usuario_sessao['name']; ?></strong></a>
			</li>
			<li class="dropdown">
				<?php echo $this->Html->link(('<i class="fa fa-sign-out"></i>'), array('controller' => 'Users', 'action'=>'logout'), array('escape'=>false, 'confirm' => 'Do you really want to logoff?', "title"=>"Logoff")); ?>
			</li>
		  </li>		
		</ul>
	  </div>
	</div>
</div>
<div class="topbar navbar navbar-default" style="background-color: white; padding-top: 0.5%">
	<div class="container-fluid" style="background-color: white;">
		<ul class="nav navbar-nav horizontal">
			<li>
				<form action="http://kwebsystems.com.br/wordLearner/searchs" method="post">
					<input name="id_usuario" hidden value="<?=$perfilVisitante['User']['id'];?>" />
					<input name="english_word" placeholder="english word" style="padding: 5px; border-radius: 2px; font-size: 13px; color: #476077;" size="30" />&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="portuguese_word" placeholder="palavra português" style="padding: 5px; border-radius: 2px; font-size: 13px; color: #476077;" size="30" />
					<button class="btn btn-primary btn-sm" style="border-radius: 2px;"><i class="fa fa-search"></i>&nbsp;&nbsp;Seach word</button>
				</form>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right user-nav">
			<li class="dropdown profile_menu">
				<li class="dropdown">
					<strong><input id="timeSearched" style="padding-top: 2.5%; border: none; font-size: 13px; color: #476077;" /></strong>
				</li>
			</li>
		</ul>
	</div>
</div>