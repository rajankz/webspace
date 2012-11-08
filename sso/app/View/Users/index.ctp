<div class="index">

    <?php
    echo $this->Form->create('User', array('action' => 'logout'));
    echo $this->Form->submit('Logout');
    echo $this->Form->end();

    ?>

</div>