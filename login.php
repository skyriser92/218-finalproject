<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Bowlby+One+SC|Press+Start+2P" rel="stylesheet">

</head>
<body id="body">

<?php
//error_reporting(E_ALL); ini_set('display_errors', '1');
// define variables and set to empty values

//Validation of email
$emailErr = $UpasswordErr = "";
$email = "";
$Upassword = "";


class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["email"])) {
		$emailErr = "*Email is required";
	} 
	else {
		$email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format"; 
		}
	}
	
		$Upassword = ($_POST["password"]);

	if (!empty($_POST["email"])) {
		$servername = "sql2.njit.edu";
		$username = "jcm44";
		$password = "lq40ntX5";
		$dbname = "jcm44";

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare("SELECT email FROM accounts WHERE email = '$email'"); 
			$stmt->execute();

			// set the resulting array to associative
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

			
			foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
					
			}

			if ($v != '') {
				$conn = null;
				$servername = "sql2.njit.edu";
				$username = "jcm44";
				$password = "lq40ntX5";
				$dbname = "jcm44";
				
				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					//echo "Connected Successfully! <br>";
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("SELECT password FROM accounts WHERE password = '$Upassword'"); 
					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

					$v = '';
					foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
						echo $v;
						echo $Upassword;
					}
						
					if ($v != '' && $Upassword != ''){
						$conn = null;
						$_SESSION["email"] = "$email";
						header( 'Location: MortalCombat.php' );
						$conn = null;
					}

					else{
						$UpasswordErr = "*Password is incorrect";
					}
				}
				catch(PDOException $e) {
					echo "Error: " . $e->getMessage();
				}
			}
			else {
				$emailErr = "*Email Incorrect";		
			}
			
			
		}		
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<div style="margin-top:60px">
<div id="main" style="width:400px; margin:auto;  padding:8px;">
  <h2 style="text-align:center; font-family: 'Press Start 2P'; color: #fff;">Login Form</h2>
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email" value="<?php echo $email; ?>">
	  <span style="color:red"><?php echo $emailErr;?></span>
    </div>
	<div class="form-group">
      <label for="Upassword">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" value="<?php echo $Upassword; ?>">
	  <span style="color:red"><?php echo $UpasswordErr;?></span>
    </div>
	    <button
    <button
    <button id="submit"type="submit" class="btn btn-primary btn-block">Submit</button>
  </form>
</div>
</div>

</body>
</html>

<style>
  #submit {
  font-family: 'Press Start 2P';
  background-color: #EE7600;
  width: 100px;
  margin: auto;
}
#submit:hover {
  background-color: #fff;
  color: #EE7600;
  transition: 1s;
  border: 1.5px dashed #EE7600;
}
#body { 
background-image: url("https://i.pinimg.com/originals/86/e5/db/86e5db557f19408081f77fd02209a5af.gif");
}
#main {
  background-color: rgb(0, 0, 255, .7);
  border: 4px dashed #fff;
  
}
Label {
  color: white;
  font-family: Work Sans;
}
</style>