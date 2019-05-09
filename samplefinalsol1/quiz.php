<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
	function getUserIpAddr(){
		//whether ip is from share internet
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   
		  {
			$ip_address = $_SERVER['HTTP_CLIENT_IP'];
		  }
		//whether ip is from proxy
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
		  {
			$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
		  }
		//whether ip is from remote address
		else
		  {
			$ip_address = $_SERVER['REMOTE_ADDR'];
		  }
		return $ip_address;
	}
?>
<?php
	$IP = getUserIpAddr();
	$numquiz = $_REQUEST['numquiz'];
	$index = 1; 
?>
<h2>Here are your results:</h2>
<table>
<?php
	while($index <= $numquiz) {    
?>
	<tr>
		<td>Question 
			<?php	
				echo $index 
			?> : 
			<?php 
						$curquestion = 'question'.$index; 
						echo $_REQUEST[$curquestion] 
			?>
		</td>
	</tr>
	<tr>
		<td>Your Answer: 
			<?php  
				$curanswer = 'answer'.$index;
				echo $_REQUEST[$curanswer];
			?>
		</td>
	</tr>
	<tr>
		<td>Correct Answer: 
			<?php 
				$curcorrectanswer = 'correctanswer'.$index;
				echo $_REQUEST[$curcorrectanswer]; 
			?>
			<br><br>
		</td>
	</tr>
<?php 
	$index++;
} ?>
</table>
<?php
	// save the new grade to quizresults.txt
	//insert votes to txt file
	$filename="quizresults.txt";
	$insertquizzerinfo = "3"."||"."4"."||".$IP."\n";
	$fp = fopen($filename,"a");
	fputs($fp,$insertquizzerinfo);
	fclose($fp);
?>
</body>
</html>
