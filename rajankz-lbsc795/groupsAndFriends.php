<div id="groupsAndFriends">
<!-- <form action="updates.php" name="groupForm" method="post"> -->
<script type="text/javascript">

$(function() {

$("#search_box").keyup(function() {
    var search_word = $("#search_box").val();
    var dataString = 'search_word='+ search_word;
	
	if(search_word=='')
	{
	}
	else
	{
	$.ajax({
	type: "GET",
    url: "searchData.php",
    data: dataString,
    cache: false,
    beforeSend: function(html) {
   
	document.getElementById("insert_search").innerHTML = ''; 
	$("#flash").show();
	$("#searchword").show();
	$(".searchword").html(search_word);
	$("#flash").html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;Loading Results...');
	               
            },
    success: function(html){
   $("#insert_search").show();
   $("#insert_search").append(html);
   $("#flash").hide();
  }
});
		
	}
		

    return false;
	});



});
</script>

	<div id="groups">
		<div class="section-head">Groups</div>
		<div class="searchGroup">
		
			<form action="" method="get">
				<input type="text" value="" name="search" id="search_box" class='search_box' />
			</form>
			<div>
			  <div id="searchword">Search results for <span class="searchword"></span></div>
			  <div id="flash"></div>
			  <ol id="insert_search" class="update">
			  </ol>
			  
			  </div>

		</div>
		

		
		<div class="section-body">
		<?php 
		include('config.inc');
		$username = $_SESSION['username'];
		//$checkedUnivArray = $_SESSION['checkedUnivArray'];

		$selectUserGroupsSql = "select un.univId, un.univName from universities un inner join userGroups ug	where un.univId = ug.univId and ug.username='$username'";
		$result = mysql_query($selectUserGroupsSql) or die(mysql_error());
		$numRows=mysql_numrows($result);
		//$selectUnivListArray = $_POST['univList'];
		echo "<ul>";
		for($i=0;$i<$numRows;$i++)
		{
			$univName = mysql_result($result, $i, "univName");
			$univId = mysql_result($result, $i, "univId");
			echo "<li>";
			echo '<label><input type="checkbox" name="univList[]" value="'.$univId.'" '; 
			if($_SESSION['newLogin']=='true'){
			echo 'checked="checked" ';
			}else{
			}
			echo '/>';
			/*if(!empty($selectUnivListArray) && in_array($univId, $selectUnivListArray))
				$checked="checked";
			else
				$checked="";
			echo $checked.'="'.$checked.'" /> ';
			*/
			echo $univName;
			echo "</label>";
			echo "</li>";
		}
		echo "</ul>";
		$_SESSION['newLogin']=='false';
		?>
		</div>
	</div>
	<div id="friends">
		<div class="section-head">Network</div>
		<div class="section-body">
			<table>
			</table>
		</div>
	</div>
<!--	</form> -->
</div>