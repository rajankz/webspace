<?php
/**
 * User: rajankz
 * Date: 7/24/12
 * Time: 2:22 PM
 */

class Worksheet extends AppModel{

	var $name = "WorksheetData";
	var $useTable = "worksheet_data";
	var $belongsTo = "Worksheet";
}

?>