<?php echo $this->element('admin_sidemenu'); ?>
<?php //echo $this->element('common'); ?>


<div id="theContent">
<h2 class="center">Admin Worksheets</h2>

<?php echo $this->element('admin_worksheet_controls'); ?>

<table>
<?php
 
echo $this->Html->tableHeaders(
    array(
    //$this->Form->input('WorksheetAll', array('type'=>'checkbox', 'label'=>false,'name'=>'worksheetAll')),	
    'Action',
      'University ID',
      'Name',
      'Status',
      'Assigned To'
    ),array('width'=>'auto'),array('width'=>'auto')
);
 
foreach($worksheets as $worksheet)
{
  echo $this->Html->tableCells(
      array(
        array(
        //$this->Form->input('data[SelectedWorksheets]',array('type'=>'checkbox', 'label'=>false,'name'=>'worksheet'.$worksheet['Worksheet']['uid'])),
        
        $this->Html->link($this->Html->image('deleteRow.png'),
        array('controller'=>'worksheets','action'=>'admin_deleteWorksheet','id'=>$worksheet['Worksheet']['id']),
        array('escape'=>false)
        ),
        
          $this->Html->link($worksheet['Worksheet']['uid'],
          array('controller'=>'worksheets','action'=>'admin_editWorksheet','id'=>$worksheet['Worksheet']['id'])
          ),
          ucwords($worksheet['Worksheet']['firstName'] ." ". $worksheet['Worksheet']['lastName']),
          $worksheet['Worksheet']['statusId'],
          $worksheet['Worksheet']['assignedToId']
        )
      )
    );
}
?>
</table>



</div>