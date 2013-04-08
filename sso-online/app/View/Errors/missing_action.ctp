<?php
	if(!empty($this->Session->request->params['admin'])){ echo $this->element('admin_navmenu');}
	if(!empty($this->Session->request->params['creator'])){ echo $this->element('creator_navmenu');}
	if(!empty($this->Session->request->params['reviewer'])){ echo $this->element('reviewer_navmenu');}
?>
<div id="theContent">
<h2>For oh! Four</h2>

<p>
    The path you are looking for either never existed or we have removed its existence.<br />
</p>
</div>