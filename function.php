<?php 
/*
email send plugin function file requirment to ad this file.....
*/
session_start();
global $queryposts;     	  
function common_search_button_list()
{
	echo " <div style='margin-top:30px !important;'> <table >
    		<tr>
    			<th colspan='10' align='center'>Select Email to Send Mail</th>
    		</tr><tr></tr>
            <tr>
            	<td>
					<input type='button' value=' a b c ' onclick='getValueUsingClass(this.value)' > 
				</td>
            	<td>
					<input type='button' value=' d e f ' onclick='getValueUsingClass(this.value)' > 
				</td>
				<td>
					<input type='button' value=' g h i ' onclick='getValueUsingClass(this.value)' > 
				</td>
				<td>
					<input type='button' value=' j k l ' onclick='getValueUsingClass(this.value)' > 
			</td>
				<td>
					<input type='button' value=' m n o ' onclick='getValueUsingClass(this.value)' > 
				</td>
				<td>
					<input type='button' value=' p q r ' onclick='getValueUsingClass(this.value)' > 
			</td>
				<td>
					<input type='button' value=' s t u ' onclick='getValueUsingClass(this.value)' > 
				</td>
				<td>
					<input type='button' value=' v w x y z ' onclick='getValueUsingClass(this.value)' > 
				</td>
				<td>
					<input type='button' value='0-9' onclick='getValueUsingClass(this.value)' > 
				</td>
				<td>
					<input type='button' value='SendMail' onclick='getValueUsingClass(this.value)' > 
				</td>
				</tr>
            </table></div>";
		global $wpdb;
		$queryposts = $_SESSION['queryposts'];
		echo "<div style='color:red'><h4> Any Problem To Email id Display So Below Query Show And Any Changesh To Go This Plugin Setting Page....!</h4></div>";
		echo "<div style='color:green'>".$queryposts."</div>";
		$posts123 = $wpdb->get_results($queryposts);
		$i=0;
		$j=5; 
		echo " <div style='margin-top:30px !important;'>" ;
		foreach ($posts123 as $value )
		{
		  	if($i==$j)
			{
				echo "<br/><br/>";
				$j=$j+5; ?>
				<input type="checkbox" id="check1" checked="checked" class="chk" value="<?php echo $value->$_SESSION['field_value']; ?>" ><?php echo $value->$_SESSION['field_value']."<br/><br/>";
			}
			else
			{ ?>
				<input type="checkbox" id="check1" checked="checked" class="chk" value="<?php echo $value->$_SESSION['field_value']; ?>" ><?php echo $value->$_SESSION['field_value']."<br/><br/>"; 
			}$i++;
		}
		echo "</div>";
}
function idsettosession()
{	
	if($_GET['id']!=",")
	{
		$_SESSION['emailid'].=$_GET['id'];
		//echo $_SESSION['emailid'];
	}
}
function Sendmailform()
{
	echo '<div style="margin-top:10px !important; margin-left:15% !important; color:green "><h1>SEND MAIL TO SELECTED MAIL ID</h1><div>';
	echo  "
    <form action='admin.php?page=bharat_email_list&' method='get'> 
		<table style='margin-top:5% !important;'>
		<tr>
    		<td style='font-size:14px; font-weight:bold; color:#300'>Subject :</td><td><input type='text' name='txtsub' id='txtsub' style='width:400px !important;'  /></td>
    	</tr>
    	<tr>
    		<td style='font-size:14px; font-weight:bold; color:#300'>Message :</td><td><textarea rows='15' cols='100' name='txtcont' id='txtmess' > </textarea></td>
    	</tr>
        <tr>
    		<td></td><td style='font-size:14px; font-weight:bold; color:#300'><input type='button' value='OkSendMail' onclick='getmessage(this.value)' ></td>
    	</tr>
    	</table>
        <form>";
}
function sendemail($to,$sub,$mess)
{
	$from = get_option('admin_email');
	$headers = "From:" . $from;
	if(mail($to,$sub,$mess,$headers))
	{
		echo "<h1 style='margin-top:20px !important; margin-left:25px !important; color:green;'>message Send Success fully</h1>	";
	}
	else
	{
		echo "<h1 style='margin-top:20px !important; margin-left:25px !important; color:red;'>message Faild Not Send Success fully Please Check Your NetWork Connection...</h1>";
	}
	//echo $to;
}
function setting()
{
	global $wpdb;
	if($_GET['option']=="SET QUERY")
	{
		$fieldname=$_GET['fieldname'];
		$tablename=$_GET['tablename'];
		$wherefieldname=$_GET['wherefieldname'];
		
		global $wpdb;
		$table_namedb = $wpdb->prefix . "bharat_plug_inquery"; 
		
		if($fieldname!="" && $tablename!="")
		{
			$query="UPDATE ".$table_namedb." SET  `fieldname`= '".$fieldname."', `tablename`= '".$tablename."' ,`wherefield`= '".$wherefieldname."' where id=1";
		}
		else
		{
			$query="";
		}
		if($wpdb->query($query))
		{
			echo '<h4>Your Query Field Set Proparly.....</h4>';
		} 
		else
		{
			echo '<h4>Your Query Field Not Set Proparly Please Propar Entry Add !.....</h4>';
		}
		echo $query;
		
	}
	//echo "<h3>Select your email id field values only query to set in use<br/>Ex....<br/>select emaiid from tablename <br/>Ex...<br/>select emaiid_field from tablename where fieidname = values .<br/></h3>";
	 echo "<table style='margin-top:5% !important;'>
		<tr>
			<td><h4>Set Selected EmailField Name :</h4></td><td><input type='text' id='fieldname'  /> </td>
		</tr>
        <tr>
			<td><h4>Set Table Name :</h4></td><td><input type='text' id='tablename'  /> </td>
		</tr>
        <tr>
			<td style='color:red'><h4> And Where To Select Email Field </h4></td><td style='color:red'> <h4>To Below Where Field Enter And This Value Atherwise You Can Not Enter Any Value . </h4></td>
		</tr>
        <tr>
			<td><h4>Set Where Field Name And Value:</h4></td><td style='color:red'><input type='text' id='wherefieldname'  /> Ex. fieldname=2 OR Ex.fieldname=BHARAT {you can not enter single cot ( ' ) }. </td>
		</tr>
        <tr>
    	<td></td><td style='font-size:14px; font-weight:bold; color:#300'><input type='button' value='SET QUERY' onclick='getquery(this.value)'  ></td>
    	</tr>
    	</table>";
}
function bharat_email_list()
{
	global $wpdb;
	$_SESSION['tablenameset'] = $wpdb->prefix . "bharat_plug_inquery"; 
		
	$query_rec_fetch = $wpdb->get_results("select * from ".$_SESSION['tablenameset']." where id=1");
	$query_make=" SELECT  ".$query_rec_fetch[0]->fieldname." FROM  ".$query_rec_fetch[0]->tablename."";
	$_SESSION['field_value']=$query_rec_fetch[0]->fieldname;
	  
	  if($query_rec_fetch[0]->wherefield!="")	   
	  {
		  $where= $query_rec_fetch[0]->wherefield;
		  $position= strpos($where, "=");
		  $where_field_name = substr($where, 0, $position);
		  $position++;
		  $where_field_value = substr($where,$position);
		  $query_make.=" WHERE (".$where_field_name."='".$where_field_value."')";
		  //$query_make.=" where (".$query_rec_fetch[0]->wherefield.")";
		  $_SESSION['where_yes_or_not_set']="Yes";
	  }
	  else
	  {
		  $_SESSION['where_yes_or_not_set']="No";
	  }
	  $_SESSION['queryposts']=$query_make;
  	//echo $query_make;
	if(!$_GET['id'])
	{
		$_SESSION['emailid']="";
	}
	if(!$_GET['search'])
	{
		if($_SESSION['where_yes_or_not_set']=="Yes")
		{
			$_SESSION['queryposts'] .= " AND (".$_SESSION['field_value']." LIKE  'a%'OR ".$_SESSION['field_value']." LIKE  'b%'OR ".$_SESSION['field_value']." LIKE  'c%')"; 
		}
		else
		{
			$_SESSION['queryposts'] .= " where (".$_SESSION['field_value']." LIKE  'a%' OR ".$_SESSION['field_value']." LIKE  'b%'OR ".$_SESSION['field_value']." LIKE  'c%')"; 
		}
		common_search_button_list();
	}
	if($_GET['search'])
	{
		$search=$_GET['search'];
		if($search=="OkSendMail")
		{
			//print_r($_SESSION['emailid']);
			$a=($_SESSION['emailid']);
			//print_r($a);
			//echo count($a);
			
			$send_id_completed="";
			$sub=$_GET['txtsub'];
			$mess=$_GET['txtmess'];
			foreach($a as $key => $val)
			{  
				$send_id_completed.=$val.",";
			}
			$send_id_completed = substr($send_id_completed, 0, -1);
			sendemail($send_id_completed,$sub,$mess);
			
		}
		else if($search == "SendMail")
			{
				idsettosession();
				$a= explode(',',$_SESSION['emailid'], -1);
				$a=(array_unique($a)); 
				$_SESSION['emailid']=$a;
				Sendmailform();
			}
			else
			{
				idsettosession();
				switch ($search)
				{
					case " a b c ":
						if($_SESSION['where_yes_or_not_set']=="Yes")
						{
							$_SESSION['queryposts'].= " AND (".$_SESSION['field_value']." LIKE  'a%'OR ".$_SESSION['field_value']. "LIKE  'b%'OR ".$_SESSION['field_value']." LIKE  'c%')"; 
						}
						else
						{
							$_SESSION['queryposts'].= " WHERE (".$_SESSION['field_value']." LIKE  'a%'OR ".$_SESSION['field_value']." LIKE  'b%'OR ".$_SESSION['field_value']." LIKE  'c%')"; 
						}
					break;
								
					case " d e f ":
						if($_SESSION['where_yes_or_not_set']=="Yes")
						{
							$_SESSION['queryposts'].= " AND (".$_SESSION['field_value']." LIKE  'd%'OR ".$_SESSION['field_value']." LIKE  'e%'OR ".$_SESSION['field_value']." LIKE  'f%')"; 
						}
						else
						{
							$_SESSION['queryposts'].= " WHERE (".$_SESSION['field_value']." LIKE  'd%'OR ".$_SESSION['field_value']." LIKE  'e%'OR ".$_SESSION['field_value']." LIKE  'f%')"; 
						}
					break;
								
					case " g h i ":
						if($_SESSION['where_yes_or_not_set']=="Yes")
						{
							$_SESSION['queryposts'].= " AND (".$_SESSION['field_value']." LIKE  'g%'OR ".$_SESSION['field_value']." LIKE  'h%'OR ".$_SESSION['field_value']." LIKE  'i%')";
						}
						else
						{
							$_SESSION['queryposts'].= " WHERE (".$_SESSION['field_value']." LIKE  'g%'OR ".$_SESSION['field_value']." LIKE  'h%'OR ".$_SESSION['field_value']." LIKE  'i%')";
						}
					break;
								
					case " j k l ":
						if($_SESSION['where_yes_or_not_set']=="Yes")
						{
							$_SESSION['queryposts'].= " AND (".$_SESSION['field_value']." LIKE  'j%'OR ".$_SESSION['field_value']." LIKE  'k%'OR ".$_SESSION['field_value']." LIKE  'l%')"; 
						}
						else
						{
							$_SESSION['queryposts'].= " WHERE (".$_SESSION['field_value']." LIKE  'j%'OR ".$_SESSION['field_value']." LIKE  'k%'OR ".$_SESSION['field_value']." LIKE  'l%')"; 
						}
					break;
							
					case " m n o ":
						if($_SESSION['where_yes_or_not_set']=="Yes")
						{
							$_SESSION['queryposts'].= " AND (".$_SESSION['field_value']." LIKE  'm%'OR ".$_SESSION['field_value']." LIKE  'n%'OR ".$_SESSION['field_value']." LIKE  'o%')"; 
						}
						else
						{
							$_SESSION['queryposts'].= " WHERE (".$_SESSION['field_value']." LIKE  'm%'OR ".$_SESSION['field_value']." LIKE  'n%'OR ".$_SESSION['field_value']." LIKE  'o%')"; 
						}
					break;
								
					case " p q r ":
						if($_SESSION['where_yes_or_not_set']=="Yes")
						{
							$_SESSION['queryposts'].= " AND (".$_SESSION['field_value']." LIKE  'p%'OR ".$_SESSION['field_value']." LIKE  'q%'OR ".$_SESSION['field_value']." LIKE  'r%')"; 
						}
						else
						{
							$_SESSION['queryposts'].= " WHERE (".$_SESSION['field_value']." LIKE  'p%'OR ".$_SESSION['field_value']." LIKE  'q%'OR ".$_SESSION['field_value']." LIKE  'r%')"; 
						}
					break;
							
					case " s t u ":
						if($_SESSION['where_yes_or_not_set']=="Yes")
						{
							$_SESSION['queryposts'].= " AND (".$_SESSION['field_value']." LIKE  's%'OR ".$_SESSION['field_value']." LIKE  't%'OR ".$_SESSION['field_value']." LIKE  'u%')"; 
						}
						else
						{
							$_SESSION['queryposts'].= " WHERE (".$_SESSION['field_value']." LIKE  's%'OR ".$_SESSION['field_value']." LIKE  't%'OR ".$_SESSION['field_value']." LIKE  'u%')"; 
						}
					break;
								
					case " v w x y z ":
						if($_SESSION['where_yes_or_not_set']=="Yes")
						{
							$_SESSION['queryposts'].= " AND (".$_SESSION['field_value']." LIKE  'v%'OR ".$_SESSION['field_value']." LIKE  'w%'OR ".$_SESSION['field_value']." LIKE  'x%' OR ".$_SESSION['field_value']." LIKE  'y%' OR ".$_SESSION['field_value']." LIKE  'z%')"; 
						}
						else
						{
							$_SESSION['queryposts'].= " WHERE (".$_SESSION['field_value']." LIKE  'v%'OR ".$_SESSION['field_value']." LIKE  'w%'OR ".$_SESSION['field_value']." LIKE  'x%' OR ".$_SESSION['field_value']." LIKE  'y%' OR ".$_SESSION['field_value']." LIKE  'z%')"; 
						}
					break;
							
					case "0-9":
						if($_SESSION['where_yes_or_not_set']=="Yes")
						{
							$_SESSION['queryposts'].= " AND (".$_SESSION['field_value']." LIKE  '0%'OR ".$_SESSION['field_value']." LIKE  '1%'OR ".$_SESSION['field_value']." LIKE  '2%' OR ".$_SESSION['field_value']." LIKE  '3%' OR ".$_SESSION['field_value']." LIKE  '4%' OR ".$_SESSION['field_value']." LIKE  '5%' OR ".$_SESSION['field_value']." LIKE  '6%' OR ".$_SESSION['field_value']." LIKE  '7%' OR ".$_SESSION['field_value']." LIKE  '8%' OR ".$_SESSION['field_value']." LIKE  '9%')"; 
						}
						else
						{
							$_SESSION['queryposts'].= " AND (".$_SESSION['field_value']." LIKE  '0%'OR ".$_SESSION['field_value']." LIKE  '1%'OR ".$_SESSION['field_value']." LIKE  '2%' OR ".$_SESSION['field_value']." LIKE  '3%' OR ".$_SESSION['field_value']." LIKE  '4%' OR ".$_SESSION['field_value']." LIKE  '5%' OR ".$_SESSION['field_value']." LIKE  '6%' OR ".$_SESSION['field_value']." LIKE  '7%' OR ".$_SESSION['field_value']." LIKE  '8%' OR ".$_SESSION['field_value']." LIKE  '9%')"; 
						}
					break;
								
					default:
						if($_SESSION['where_yes_or_not_set']=="Yes")
						{
							$_SESSION['queryposts'].= " AND (".$_SESSION['field_value']." LIKE  'a%'OR ".$_SESSION['field_value']." LIKE  'b%'OR ".$_SESSION['field_value']." LIKE  'c%')"; 
						}
						else
						{
							$_SESSION['queryposts'].= " WHERE (".$_SESSION['field_value']." LIKE  'a%'OR ".$_SESSION['field_value']." LIKE  'b%'OR ".$_SESSION['field_value']." LIKE  'c%')"; 
						}
					}
					common_search_button_list();
			}
		
	}
}
