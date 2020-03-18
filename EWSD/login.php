<?php
if (!isset($_SESSION)) {
    session_start();
}

$s = "s";
$t = "t";

if(isset($_SESSION['role']) &&  $_SESSION['role'] == $s){
		
	header("location: S_dash.php");
	exit();
}
	
else if(isset($_SESSION['role']) &&  $_SESSION['role'] == $t){
		
	header("location: T_dash.php");
	exit();
}

include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $uname = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['psw']);
    $p_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM user_acc WHERE Uname='$uname'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $db_p_hash = $row['Pword'];
            $acc_status = $row['status'];
			$role = $row['role'];
        }
    } else {

        header("location: login.php");
    }

    if (!password_verify($password, $db_p_hash)) {

        echo "<script type='text/javascript'>alert('Wrong Name / Password');</script>";

    } else {

        if ($acc_status == 1) {

            echo $uname;
            setcookie("cookie_name", $uname, time() + (86400 * 30), "/");
            $_SESSION['username'] = $uname;
            $_SESSION['role'] = $role;
			$s = "s";
			$t = "t";
					
			if ($_SESSION['role'] == $s){
				header("location: S_dash.php");
				exit();
			}
					
			else if ($_SESSION['role'] == $t){
				header("location: T_dash.php");
				exit();
			}

        } else {

            echo "<script type='text/javascript'>alert('Please Go Check Your Mail To Activate Account');</script>";

        }

    }

    $conn->close();
}

?>

<?php include 'S_nav.php';?>
<html>
<head>
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" href="logandsign.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
</head>

<body>

<br><br><br>
<form class="formlg "action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="post">
<div class="containerlog">
    <h1>Login</h1>
    <hr>

    <br><label for="username"><b>Username</b></label>
    <br><input type="text"  placeholder="Enter Username" name="username" value="<?php if (isset($_COOKIE["cookie_name"])) {echo $_COOKIE["cookie_name"];}?>" required>

    <br><label for="psw"><b>Password</b></label>
    <br><input type="password" placeholder="Enter Password" name="psw" required>

    <div class="button">
    <button type="submit" class="Login">Login</button>

    <p style="padding-bottom:2%;padding-left:10%;">No Account?</p>
    <button type="button" class="signupbtn" onclick="location.href='signup.php'" >Sign Up</button>
    </div>

    <p style="padding-bottom:5%;padding-left:63%;"><a href="Gtaskv.php">-->CONTINUE BY GUEST--></a></p>
</div>
</form>

</body>

</html>
