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
	<base href="<?php echo $base_url ?>" />
	<style>
	#changeFont {
	position:absolute;
	top:15px;
	right:0px;
	background-color:#555;
	padding:5px;
	border-radius: 3px;
}
.increaseFont, .decreaseFont, .resetFont {
	text-decoration: none;
	color:#CCCCCC;
	font-size:14px;
	float:left;
	margin:5px 10px;
}
.increaseFont:hover, .decreaseFont:hover, .resetFont:hover {
	color:#FFFFFF;
}

	</style>

	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $siteDescription; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('fonts');
		//echo $this->Html->css('bootstrap');
		echo $this->Html->css('sso');
        echo '<link rel="stylesheet" href="http://www.umd.edu/wrapper/css/xhtml-1020px.css" />';
        echo $this->Html->script('jquery-1.7.2.min.js');
        echo $this->Html->script('jquery.validate.min.js');
        echo $this->Html->script('additional-methods.min.js');
        echo $this->Html->script('functions.js');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<script type="text/javascript" language="javascript">
	$(document).ready(function(){
  // Reset Font Size
  var originalFontSize = $('html').css('font-size');
    $(".resetFont").click(function(){
    $('html').css('font-size', originalFontSize);
  });
  // Increase Font Size
  $(".increaseFont").click(function(){
    var currentFontSize = $('html').css('font-size');
    var currentFontSizeNum = parseFloat(currentFontSize, 10);
    var newFontSize = currentFontSizeNum*1.2;
    $('html').css('font-size', newFontSize);
    return false;
  });
  // Decrease Font Size
  $(".decreaseFont").click(function(){
    var currentFontSize = $('html').css('font-size');
    var currentFontSizeNum = parseFloat(currentFontSize, 10);
    var newFontSize = currentFontSizeNum*0.8;
    $('html').css('font-size', newFontSize);
    return false;
  });
});
</script>
<body id="body">
<div id="umd-frame" style="margin: auto">
    <div id="umd-frame-header">
        <a href="http://www.umd.edu/"><img src="http://www.umd.edu/wrapper/images/header-um-logo.gif" alt="University of Maryland" id="umd-frame-logo" /></a>
        <div id="umd-frame-header-end"></div>
    </div>

	<div id="container">
		<div id="header">
            <!--<div id="usability">
               <a href="javascript:void(0);" onclick="changeFont('2');">A+</a><span> </span>
               <a href="javascript:void(0);" onclick="resetFont();">A</a><span> </span>
               <a href="javascript:void(0);" onclick="changeFont('-2');">A-</a>

            </div>
            -->
            <div id="changeFont">
				<a href="#" class="increaseFont">A+</a>
				<a href="#" class="resetFont">A</a>
				<a href="#" class="decreaseFont">A-</a>				
			</div>

            <div id="banner">
            <?php echo $this->Html->link(
                $this->Html->image('sso-banner.jpg',array('alt' => $siteDescription, 'border' => '0')),
                '/',
                array('target' => '_self', 'escape' => false)
            );
            ?>
            </div>
		</div>
		<div id="contentWrapper">
            <?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth');?>
			<a name="top"></a>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php //echo $this->Html->link(
                //$this->Html->image('webglobelg.gif',array('alt' => 'University of Maryland', 'border' => '0', 'class'=>'floatLeft')),'http://www.umd.edu', array('target' => '_self', 'escape' => false));?>

            <h3>Student Success Office</h3><hr style="width:80%" /><br />
            0110 Hornbake Library<br>
            <a href="http://www.ugst.umd.edu" class="blackonwhite">Office of Undergraduate Studies<br>
            </a> <a href="http://www.umd.edu" class="blackonwhite">University of Maryland</a><br />
            College Park, MD 20742 <br>
            </p>
            <?php //echo $this->element('sql_dump'); ?>
		</div>
	</div>
</div>
</body>
</html>
