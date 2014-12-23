<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
<link rel="shortcut icon" href="<?php echo base_url('asset/images/favicon.png');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/reset.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/login.css');?>" />
<title><?php echo $title;?></title>
</head>
<body id="login_box">
	<h1>Login Absensi</h1>
	<?php
		$attributes = array('name'=>'login_form','id'=>'login_form');
		echo form_open('login',$attributes);
	?>
	<?php if(isset($pesan)):?>
		<p id="message"><?php echo $pesan;?></p>
	<?php endif?>
	<p>
		<label for="username">Username:</label>
		<input type="text" name="username" size=20 class="form_field" value="<?php echo set_value('username');?>">
	</p>
		<?php echo form_error('username','<p class="field_error">','</p>')?>
	<p>
		<label for="password">Password:</label>
		<input type="password" name="password" size=20 class="form_field" value="<?php echo set_value('password');?>">
	</p>
		<?php echo form_error('password','<p class="field_error">','</p>')?>
	<p><input type="submit" name="submit" id="submit" value="Login"></p>
	</form>
</body>
</html>