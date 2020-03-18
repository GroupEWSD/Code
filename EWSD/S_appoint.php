<?php
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
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	

		$sName = mysqli_real_escape_string($conn, $_SESSION['username']);
		$aDate = mysqli_real_escape_string($conn, $_POST['aDate']);
		$aTime = mysqli_real_escape_string($conn,$_POST['aTime']);
		$aType = mysqli_real_escape_string($conn,$_POST['aType']);
		$aTutor = mysqli_real_escape_string($conn,$_POST['aTutor']);
		$aReason = mysqli_real_escape_string($conn,$_POST['aReason']);
				
	    $sql = "SELECT * FROM user_acc WHERE Uname ='$aTutor' AND role ='t'";
	    $result = mysqli_query($conn, $sql);
	
		if ($result->num_rows > 0){
			
			while($row = $result->fetch_assoc()) {
				
				
				$tMail = $row['Uemail'];
			}
		}
		
	    if(!empty($sName)&&(!empty($aDate)&&!empty($aTime)&&!empty($aType)&&!($aTutor)&&!empty($aReason))){
			
			$get_user = "SELECT * FROM appointment WHERE student ='$sName' AND date ='$aDate' AND time = '$aTime' AND status ='Accept'";
			$rowresult = mysqli_query($conn, $get_user);
					
						
						if ($rowresult->num_rows > 0){
						
							$message = "Appointment already make.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						
						}
					
						else {
				
				        $sql = "INSERT INTO appointment(student,date, time, type, tutor,reason)
						VALUES ('$sName', '$aDate', '$aTime', '$aType', '$aTutor', '$aReason')";
						
							if($result = mysqli_query($conn, $sql)){
										
							   $msg = "Task Uploaded Successfully";
							   echo "<script type='text/javascript'>alert('$msg');</script>";
							
							
						
	
					
					
					$mail = new PHPMailer(TRUE);
					$mail->isSMTP();
					$mail->SMTPDebug = SMTP::DEBUG_SERVER;
					$mail->Host = 'smtp.gmail.com';
					$mail->Port = 587;
					$mail->SMTPSecure = "tls";
					$mail->SMTPAuth = true;
					$mail->Username = 'bryanteo98@gmail.com';
					$mail->Password = 'vgbbsgckqegqwdia';
								
                                    
					$mail->setFrom('jojo@jotaro.com', 'DIO');

					$mail->addAddress($tMail , $aTutor);

					$mail->Subject = 'Email Verification';

					$mail->Body = "<html></body><div style='padding-top:8px;'>Your have a appointment awaiting for confirmation</div>
					</body></html>";

					$mail->isHTML(true);
								
					if($mail->send()){
							
										$message = "Email Sent";
										echo "<script type='text/javascript'>alert('$message');</script>";
										header("refresh:1;url=appoint.php");
							
									}
							
									else {
								
										echo "Error, Email not sent.";
								
									}
						}
				}
				
				
				
			}
			else {
									
					$msg = "Task Failed to Upload";
					echo "<script type='text/javascript'>alert('$msg');</script>";
									
					echo "Error: " . $sql . "<br>" . $conn->error;
				    }
	}
?>
<html>
<title> Appointment </title>
<head>
<style>
p{
	font-family:Arial;
	font-size:18px;
	color:black;
}

button {
    background-color: #215ECF;
    border: none;
    color: white;
    padding: 10px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

.div1 {border-radius: 12px;}

.div2 {border-radius: 12px;}

 table, th, td {
       border: 1px solid white;
       border-collapse: collapse;
    }
       th, td {
       padding: 15px;
    }
	   a {
		   color : blue;
	}
	
</style>
</head>
<body>
<div class="div div1" align = "center" style = "background-color:#0DEBF6;width:auto;height:auto;margin-top:0px">
   <br>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
<div>
			Date : <input type='date' name='aDate'><br><br>
			Time : <select id="aTime" name="aTime">
			<option value="2:00pm-3.00pm">2:00pm - 3.00pm</option>
			<option value="4.00pm-5.00pm">4.00pm - 5.00pm</option>
			</select><br><br>
			Appointment Type : <select id="aType" name="aType">
			<option value="virtual">Virtual</option>
			<option value="realtime">Real-Time</option>
			</select><br><br>
			Tutor : <select id="aTutor" name="aTutor">
			
			<?php
			
			echo "<option>Tutor Name</option>";
			$sql ="SELECT * FROM user_acc WHERE role ='t'";
			$resultx=mysqli_query($conn,$sql);
			
			if(mysqli_num_rows($resultx)>0){

				
				while($row=mysqli_fetch_array($resultx)){
				
					$tutor=$row['Uname'];
					echo "<option value=$tutor>$tutor</option>";
				
				}
			}
			?>
			</select><br><br>
			Reason : <textarea name ="aReason" placeholder = "Reason..." cols = "37" rows = "5" Style = "font-size:14px;"></textarea><br>
			<button type="submit" name="appointment" class="button">Make Appointment</button>
</div><br>
</form>
<div>
</body>
</html>