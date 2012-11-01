/**
 * User: rajankz
 * Date: 7/25/12
 * Time: 12:07 PM
 */
$(document).ready(function()
{
    $(".defaultText").focus(function(srcc)
    {
        if ($(this).val() == $(this)[0].title)
        {
            $(this).removeClass("defaultTextActive");
            $(this).val("");
        }
    });

    $(".defaultText").blur(function()
    {
        if ($(this).val() == "")
        {
            $(this).addClass("defaultTextActive");
            $(this).val($(this)[0].title);
        }
    });

    $(".defaultText").blur();    
    
});

function validateForm(){
	var $uid = $('#WorksheetUid').val();
	if(isNaN($uid)){
		alert('University ID should be all numbers');
		return false;
	}
	if($uid.length==9){
		return true;
	}else{
		alert('Univeristy ID should be 9-digits long');
		return false;
	}
}