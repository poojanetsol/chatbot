<?php
$cakeDescription = 'Solal';
?>
<!DOCTYPE html>
<html>
	<head>
		<?php echo  $this->Html->charset() ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			<?php echo  $cakeDescription ?>:
			<?php echo  $this->fetch('title') ?>
		</title>
		<?php echo  $this->Html->meta('icon') ?>

		<!-- Bootstrap -->
		<?php echo $this->Html->css('../theme/bootstrap/css/bootstrap.min.css'); ?>
		<!-- Font Awesome -->
		<?php echo $this->Html->css('../theme/bootstrap/css/bootstrap-responsive.min.css'); ?>   

		<!-- Custom Theme Style -->
		<?php echo $this->Html->css('../theme/assets/styles.css'); ?>
		<?php echo $this->Html->css('style.css'); ?>
		<?php echo $this->Html->script('../theme/vendors/modernizr-2.6.2-respond-1.1.0.min.js'); ?>
		<?php echo  $this->fetch('meta') ?>
		<?php echo  $this->fetch('css') ?>
	</head>
	<body id="login">
		<div class="container">
			<?php echo  $this->fetch('content') ?>
		</div> <!-- /container -->
    <?php echo $this->Html->script('../theme/vendors/jquery-1.9.1.min.js'); ?>
	<?php echo $this->Html->script('../theme/bootstrap/js/bootstrap.min.js'); ?>
    <?php echo  $this->fetch('script') ?>
  </body>
</html>
