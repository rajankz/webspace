<div id="events-calendar" class="">
	<table id="events-table">
	<tbody>
		<?php
		$rootpath = $_SESSION['aastHome'];
		$eventsMainPath = $rootPath . "/stayConnected/index.php?p=newsAndEvents&";
		$xml = simplexml_load_file($rootPath . "/xmls/newsAndEvents.xml");

		//each child is a news item
		$itemCount = 5;
		$result = $xml->xpath('OneItem/OneEvent');
		if($result)
		foreach($result as $event)
		{
			if($itemCount-- <= 0)
				break;
			//$expireDate = strtotime((string)$event->expire_date);
			//if expire date is valid and less than current date then do not show this post
			//if($expireDate && (time() > $expireDate)) 
				//continue;

			$name = $event->name;
			$title = $event->title;
			$eventDate = strtotime((string)$event->eventDate);
		?>   
			<tr>
				<td class="image">
					<div class="event-date">
						<div class="event-day"><?=date('d', $eventDate)?></div>
						<div class="event-month"><?=date('M', $eventDate)?></div>
					</div>

				</td>
				<td class="event-title"><a href="<?=$eventsMainPath."id=".$name?>"><?=$title?></a>

				</td>
			</tr>
		<? 
		  }?>
	</tbody></table>
	<div class="floatRight bold"><span><a href="">All Events	...</a></span></div>
</div>
<div class="clear-both"></div>
