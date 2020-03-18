<?php
include 'T_nav.php';
include 'dbcon.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'C:\xampp\composer\vendor\autoload.php';


 if (!isset($_SESSION)) {
    session_start();
  }

  if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
  }
  
  $tName = mysqli_real_escape_string($conn, $_SESSION['username']);
  
  $sql = "SELECT * FROM appointment WHERE status = 'Pending' && tutor = '$tName'";
  $result1 = mysqli_query($conn, $sql);
?>

<html>
<title> Tutor Appointment </title>
<head>
</head>
<body>
<div class="div div1" align = "center" style = "background-color:#0DEBF6;width:auto;height:100%;margin-top:0px">
   <br>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
<<div class='div div1' align = 'center' style = 'background-color:#437EFA;width:65%;height:auto;margin-top:0px'>
<table width='900'>
<?php
			if (mysqli_num_rows($result1) > 0){
			
			while($row = $result1->fetch_assoc()) {
				
				$id = $row['id'];
				$student = $row['student'];
				$date = $row['date'];
				$time = $row['time'];
				$type = $row['type'];
				$reason = $row['reason'];
				
				echo "
					  <tr><th>Student</th><th>Date</th><th>Time</th><th>Type</th><th>Reason</th><th>Response</th></tr>
					  <tr><td name='name'>$student</td>
					  <td name='date'>$date</td>
					  <td name='time'>$time</td>
					  <td name='type'>$type</td>
					  <td><p rows='6' cols='30' type='text' name='details' style='font-size:14px;'>".$reason."</p></td>
					  <td><a class='button' href='accept.php?id=$id&student=$student' onclick='return checkAccept()'><button style='width:40%;background-color:white;color: black;' class='button' type='button'>Accept</button></a><a class='button' href='decline.php?id=$id&student=$student' onclick='return checkAccept()'><button style='width:40%;background-color:white;color: black;' class='button' type='button'>Decline</button></a></td>
					  </div><br><br>";
			}		
		
		}
		
		else {
		
			$msg = "No Record Found";
			echo "<script type='text/javascript'>alert('$msg');</script>";
			header("refresh:0; url=main2.php");
		}
	
		?>
		</table><br>
</div><br>
</form>
<div>
</body>
</html>