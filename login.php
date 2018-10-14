<?php
session_start();

include './partials/head.html';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university";
$conn = new mysqli($servername, $username, $password, $dbname);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $_SESSION["username"] = $_POST['username'];
  $_SESSION["pass"] = $_POST['password'];
  header("Location: home.php");
  // $sql="SELECT * FROM users WHERE username={$_POST['username']} AND password={$_POST['password']}";
  // $results = $conn->query($sql);
  // if ($results->num_rows > 0){
  //   while($data = $results->fetch_assoc()){
  //     $_SESSION['id']=$data['id'];
  //     $_SESSION['username'] = $data['username'];
  //     $_SESSION['success'] = "You are now logged in!";
  //   }
  // }else{
  //   echo "error retrieving user";
  // }

  // $password = crypt($password, '$1$something');





	//now compare this md5 hash with the stored hashed password for this user (if this user exists)

	// forward the user to home page if login was successful.


}else{

//remove all session variables
session_unset();

// destroy the session
session_destroy();

?>
<form action="login.php" method="POST">
	<p>Please Log in:
	<br />
	<span>Username <input type="Text" name="username"/> </span>
	<br>
	<br />
	<span>Password <input type="password" name="password"/> </span>
	</p>
	<input type="Submit" value = "Log in"/>
</form>


<?php
}

?>
