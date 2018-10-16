

<html>
<head>
  <?php include './partials/head.html'; ?>
</head>
<body>
  <?php include './partials/header.html'; ?>
<img src="./public/images/success.png"></img>
<br>
<br>
<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql="SELECT * FROM users WHERE users.username={$_POST['username']} AND users.password={$_POST['password']}";
$results = $conn->query($sql);
if ($results->num_rows > 0){
  while($data = $results->fetch_assoc()){
    $_SESSION['id']=$data['id'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['success'] = "You are now logged in!";
  }
}else{
  echo "error retrieving user";
}


if($_SESSION['username'] != null){
  echo "Welcome, ".$_SESSION["username"];
  $sql = "SELECT * FROM course";
	$result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
      $result_set[] = $row;
    }
    echo "
    		<table>
          <tr>
            <th>
              Course ID
            </th>
            <th>
              Title
            </th>
            <th>
              Department
            </th>
            <th>
              Credits
            </th>
          </tr>
    ";
    foreach ($result_set as $row) {
      echo "
          <tr>
            <td>
              {$row["course_id"]}
            </td>
            <td>
              {$row["title"]}
            </td>
            <td>
              {$row["dept_name"]}
            </td>
            <td>
              {$row["credits"]}
            </td>
          </tr>
      ";
    }
    echo "
		</table>";
  }
}else{
  header('location: login.php');
}

?>

</body>
</html>
