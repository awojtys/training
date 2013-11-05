<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
                
                echo $this->Html->css('bootstrap-theme');
                echo $this->Html->css('bootstrap');
                
                echo $this->Html->script('jquery-1.10.2.min');
                echo $this->Html->script('html5');
                echo $this->Html->script('bootstrap');
                echo $this->Html->script('backbone-min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
            <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
                <ul class="nav navbar-nav">
                    <?php if($this->Session->read('Auth.User') != null)
                    {
                        ?>
                        <li><?php echo $this->Html->link('Szkolenia', array('controller' => 'trainings', 'action' => 'viewall')); ?></li>
                        <li><?php echo $this->Html->link('Zawód uczestników', array('controller' => 'positions', 'action' => 'viewall')); ?></li>
                        <li><?php echo $this->Html->link('Oferowane materiały', array('controller' => 'trainings', 'action' => 'add')); ?></li>
                        <?php
                    }
                    ?>
                    <li><?php echo $this->Html->link('Zapisy na szkolenia', array('controller' => 'records', 'action' => 'viewall')); ?></li>
                    <li><?php echo $this->Html->link('Kontakt', array('controller' => 'homes', 'action' => 'contact')); ?></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if($this->Session->read('Auth.User') == null)
                        {
                            ?>
                            <li><?php echo $this->Html->link('Zaloguj', array('controller' => 'auths', 'action' => 'login')); ?></li>
                            <?php
                        }
                        else
                        {
                            ?>
                            <li><?php echo $this->Html->link('Wyloguj', array('controller' => 'auths', 'action' => 'logout')); ?></li>
                            <?php
                        }
                        ?>
                </ul>
            </nav>