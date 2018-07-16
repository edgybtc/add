<?php
$mssg="";
$servername="localhost";
$username="root";
$password="7.}B-ysJXMnnB@'C";
$dbname="panel";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

		 if (isset($_POST["username"]) && !empty($_POST["username"]) && $_POST["password"]) && !empty($_POST["password"]))
		 {
			$mssg="Login Failed";
			$username= strval($_POST["username"]);
			$password= strval($_POST["password"]);
	    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
$stmt->bind_param('s', $username); // 's' specifies the variable type => 'string'

$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
if($row['password']==$password){
	$mssg="Login Succesful";
	$conn->query("UPDATE users SET last_login=now() WHERE username=\"$username\"");
}
}
	
	 
			 
			 
		 }


?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
	  <?php echo '<br>'.$mssg.'<br>'; ?>
	  <form action="index.php" method="post">

      <label for="inputEmail" class="sr-only">Username</label>
      <input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
	
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	  </form>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>
</html>
