<?php echo $this->element('admin_navmenu'); ?>
<div id="theContent">
<h2 class="center">User Settings</h2>
<table>
<?php
 
echo $this->Html->tableHeaders(
    array(
      'Username',
      'Email',
      'Role',
      'Is Active'
    )
);
 
foreach($users as $user)
{
  echo $this->Html->tableCells(
      array(
        array(
          $this->Html->link($user['User']['username'],
          array('controller'=>'dashboard','action'=>'admin_userEdit','userId'=>$user['User']['id'])
          ),
          $user['User']['emailId'],
          $user['User']['role'],
          ($user['User']['is_active']=='1'?'Yes':'No')
        )
      )
    );
}
?>
</table>

<div id="userControls" class="actionLink">  
	<span class="floatLeft">  
		<?php echo $this->Html->link('Add User', array('controller'=>'users','action'=>'register')); ?>  
	</span>
	<div class="clearBoth"></div>
</div>
</div>
