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

<?php
echo $this->Form->create('User', array('action' => 'register'));
echo $this->Form->submit('Add User');
echo $this->Form->end();
?>
</div>
