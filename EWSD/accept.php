<?php

	include 'dbConn.php';
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    require 'C:\xampp\composer\vendor\autoload.php';
	
	if(empty($_SESSION)){
		
		session_start();
	}
	
	$id=$_REQUEST['id'];
	$student= mysqli_real_escape_string($conn, $_REQUEST['student']);
	$Uname = $_SESSION['username'];
	
	$query = "UPDATE appointment SET status ='Accept' WHERE id ='$id'";
		
		if(mysqli_query($conn, $query)){
			
			echo $student;
			
			$sql = "SELECT * FROM user_acc WHERE Uname ='$student' AND role='s'";
			$result = mysqli_query($conn, $sql);
			
			if ($result->num_rows > 0){
			
				while($row = $result->fetch_assoc()) {
				
				
					$sMail = $row['Uemail'];
				
				}
			}
				 echo $sMail;
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

				$mail->addAddress($sMail , $student);

				$mail->Subject = 'Appointment Verification';

				$mail->Body = "<html></body><div style='padding-top:8px;'>Your appointment has been accepted</div>
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
						
				header("Location: T_Appoint.php"); 	
			
			
			
			
		}

?>