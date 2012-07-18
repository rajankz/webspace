<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $siteDescription = 'University of Maryland - Student Success Office'; ?>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $siteDescription; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('sso');
        echo '<link rel="stylesheet" href="http://www.umd.edu/wrapper/css/xhtml-1020px.css" />';
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
<div id="umd-frame" style="margin: auto">
    <div id="umd-frame-header">
        <a href="http://www.umd.edu/"><img src="http://www.umd.edu/wrapper/images/header-um-logo.gif" alt="University of Maryland" id="umd-frame-logo" /></a>
        <div id="umd-frame-header-end"></div>
    </div>

	<div id="container">
		<div id="header">
            <?php echo $this->Html->link(
                $this->Html->image('sso-banner.jpg',array('alt' => $siteDescription, 'border' => '0')),
                'http://studentsuccess.umd.edu/',
                array('target' => '_self', 'escape' => false)
            );
            ?>
		</div>
		<div id="content">
            <?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth');?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
            Student Success Office<br>
            0110 Hornbake Library<br>
            <a href="http://www.ugst.umd.edu" class="blackonwhite">Office of Undergraduate Studies<br>
            </a> <a href="http://www.umd.edu" class="blackonwhite">University of Maryland</a>,
            College Park, MD 20742 <br>
            <a href="mailto:rr-admit@umd.edu " class="blackonwhite">rr-admit@umd.edu </a>
            </p>
		</div>
	</div>
</div>
</body>
</html>
