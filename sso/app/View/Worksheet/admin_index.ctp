<?php //debug($this); exit; ?>
<?php echo $this->element('admin_sidemenu'); ?>
<?php //echo $this->element('common'); ?>


<div id="theContent">
<h2 class="center">Admin Worksheets</h2>

<?php echo $this->element('admin_worksheet_controls'); ?>

<?php echo $this->element('allWorksheetsIndex'); ?>



</div>