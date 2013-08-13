
function getValueUsingClass(value)
{
    /* declare an checkbox array */
    var chkArray = [];
     
    /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
    $(".chk:checked").each(function() {
        chkArray.push($(this).val());
    });
     
    /* we join the array separated by the comma */
    var selected;
    selected = chkArray.join(',') + ",";
     
    /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
   	window.location = 'admin.php?page=bharat_email_list&search='+ value+'&id='+selected;
}

function getmessage(mess)
{
    var txtsub = document.getElementById("txtsub").value;
	var txtmess = document.getElementById("txtmess").value;
	window.location = 'admin.php?page=bharat_email_list&search='+mess+'&id=,'+'&txtsub='+txtsub+'&txtmess='+txtmess;
}
function getquery(mess1)
{
    var fieldname = document.getElementById("fieldname").value;
	var tablename = document.getElementById("tablename").value;
	var wherefieldname = document.getElementById("wherefieldname").value;
	window.location = 'admin.php?page=setting&option='+mess1+'&fieldname='+fieldname+'&tablename='+tablename+'&wherefieldname='+wherefieldname;
}
 
/*function getValueUsingClass1(value1){ 
$.ajax({
        type: 'POST',
        url: 'admin.php?page=bharat_email_list',
		dataType: 'json',
        data: {'email_id':value1},
        success: function(result){
                
            
            
        }
    });

}*/

