<div class="login-container">
	<div class="middle-login">
		<div class="block-flat">
			<div class="content">
				<?php echo $this->Form->create('User');?>
				<?php echo $this->Form->input('username', array('label'=>false, 'type'=>'text', 'placeholder'=>'User', 'autofocus')); ?>
				<?php echo $this->Form->input('password', array('label'=>false, 'type'=>'password', 'placeholder'=>'Password')); ?>
				<?php echo $this->Form->button('Login', array('type'=>'submit',
					'style'=>'
					height: 35px;
					background: #fff;
					border: 1px solid #fff;
					cursor: pointer;
					border-radius: 2px;
					color: #a18d6c;
					font-family: Arial;
					font-size: 16px;
					font-weight: 400;
					padding: 6px;
					margin-top: 10px;
					font-weight: bold;
					color: #dc060f;
					width: 260px;',
					
					'onMouseOver'=>'this.style.opacity=0.8',
					'onMouseOut'=>'this.style.opacity=1'
					
					));
				?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
  $("#cl-wrapper").css({opacity:1,'margin-left':0});
});
</script>