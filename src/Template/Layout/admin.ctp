<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
	<?php echo $this->Html->css('../theme/bootstrap/css/bootstrap.min.css'); ?>
	<?php echo $this->Html->css('../theme/bootstrap/css/bootstrap-responsive.min.css'); ?>
	<?php echo $this->Html->css('../theme/vendors/easypiechart/jquery.easy-pie-chart.css'); ?>
	<?php echo $this->Html->css('../theme/assets/styles.css'); ?>
	<?php echo $this->Html->css('style.css'); ?>
	<?php echo $this->Html->script('../theme/vendors/modernizr-2.6.2-respond-1.1.0.min.js'); ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
    <body>
        <?php 
		/* header*/
		echo $this->element('header');?>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php /* sidebar*/echo $this->element('left-sidebar');?>
               
                <div class="span9" id="content">
					<div class="row-fluid">
						<?= $this->fetch('content') ?>
					</div>
                </div>
            </div>
            <hr>
            <?php /*Footer*/echo $this->element('footer');?>
        </div>
        <!--/.fluid-container-->
		<?php echo $this->Html->script('../theme/vendors/jquery-1.9.1.min.js'); ?>
		<?php echo $this->Html->script('../theme/bootstrap/js/bootstrap.min.js'); ?>
		<?php echo $this->Html->script('../theme/vendors/easypiechart/jquery.easy-pie-chart.js'); ?>
		<?php echo $this->Html->script('../theme/assets/scripts.js'); ?>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>
    </body>
</html>
