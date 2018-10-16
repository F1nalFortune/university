<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include './partials/head.html';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (!mysqli_query($conn,"CREATE TABLE IF NOT EXISTS users (
      id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      username VARCHAR(30) NOT NULL,
      password VARCHAR(30) NOT NULL)"))
		{
		echo("Error description: " . mysqli_error($conn). "<br/>");
		}




  //prepare and bind
  $stmt = $conn->prepare("INSERT INTO `users`(username, password) VALUES (?,?)");
  $stmt->bind_param("ss", $user, $pass);

  //set parameters and execute
  $user = $_POST['username'];
  $pass = crypt($_POST['password'], '$1$mysalt');
  $stmt->execute();
  echo "New user created successfully";


	//now compare this md5 hash with the stored hashed password for this user (if this user exists)

	// forward the user to home page if login was successful.
	header("Location: login.php");

  $stmt->close();
  $conn->close();

}else{


  ?>
  <form action="register.php" method="POST">
  	<p>Please Register</p>
  	<br />
  	<div>Username <input type="Text" name="username"/> </div>
  	<br>
  	<br />
  	<div>Password <input type="password" name="password"/> </div>
    <!-- <div>Password (again):<input type='password' name='password'/></div> -->
  	<input type="Submit" value = "Log in"/>
  </form>


  <?php
  }


  ?>
