<?php
$bdd = new PDO('mysql:host=localhost;dbname=site;charset=utf8', 'maxime', '1234m');
if (isset($_POST['formsend'])) {
	$firstname = htmlspecialchars($_POST['firstname']);
		$lastname = htmlspecialchars($_POST['lastname']);
		$colors = $_POST['color'];
	if (!empty($_POST['firstname']) && !empty($_POST['lastname'])) {
		$insert = "INSERT INTO users(first_name, last_name, color) VALUES ('$firstname', '$lastname', '$colors')";		
		if ($bdd->exec($insert) == false) {
			echo "Error";
		} else {
			echo "Good";
		}
	} else {
		echo "Error";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Users and colors</title>
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
	<center><h1> Create User </h1></center>
	<form method="POST" action="">
		<div class="input-group">
		  <div class="input-group-prepend">
		    <span class="input-group-text">Fist Name</span>
		  </div>
		  <input type="text" class="form-control" aria-label="With textarea" name="firstname" id="firstname" </input>
		</div>
		<div class="input-group">
		  <div class="input-group-prepend">
		    <span class="input-group-text">Last Name</span>
		  </div>
		  <input class="form-control" aria-label="With textarea" name="lastname" id="lastname"></input>
		</div>
		  <div class="form-group">
			  <label for="sel1">Color:</label>
			  <select class="form-control" id="sel1" name="color" id="color">
			    <option>Blue</option>
			    <option>Green</option>
			    <option>Red</option>
			    <option>Yellow</option>
			    <option>Black</option>
			    <option>White</option>
			  </select>
		</div>
		</div>
		<center><input type="submit" class="btn btn-secondary" value="submit" name="formsend"></input></center>
</form>

<br><br>
<center><h1>Found user</h1></center>
<form method="GET">
	<div class="form-group">
			  <label for="sel1">Search by:</label>
			  <select class="form-control" id="sel1" name="scolor" id="scolor">
			    <option>First Name</option>
			    <option>Last Name</option>
			    <option>Color</option>
			  </select>
		</div>
	<input type="search" name="found" placeholder="To found.." />
	<input type="submit" value="Go">

</form>

<div class="container">
  <div class="row">
    <div class="col-sm">
    	First Name
    </div>
    <div class="col-sm">
    	Last Name
    </div>
    <div class="col-sm">
    	Color
    </div>
  </div>
</div>

<?php

$reponse = $bdd->query('SELECT * FROM users');

if (isset($_GET['found']) && !empty($_GET['found'])) {
		$query = htmlspecialchars($_GET['found']);
		if (isset($_GET['scolor']) && $_GET['scolor'] == 'First Name') {
			$reponse = $bdd->query('SELECT * FROM users WHERE first_name LIKE "%'.$query.'%" ORDER BY id DESC');
		} else if (isset($_GET['scolor']) && $_GET['scolor'] == 'Last Name') {
			$reponse = $bdd->query('SELECT * FROM users WHERE last_name LIKE "%'.$query.'%" ORDER BY id DESC');
		} else if (isset($_GET['scolor']) && $_GET['scolor'] == 'Color') {
			$reponse = $bdd->query('SELECT * FROM users WHERE color LIKE "%'.$query.'%" ORDER BY id DESC');
		}
	}
while ($users = $reponse->fetch()) { ?>
	<div class="container">
		<div class="row">
    		<div class="col-sm">
    			<?php echo $users['first_name'];?>
    			<div class="last_name">
    				<?php echo $users['last_name']; ?></p></div>
    			<div class="color">
    				<p><?php echo $users['color']; ?></p>
    			</div>
	    	</div>
  		</div>
	</div>

<?php
	}
	$reponse->closeCursor()
?>
</body>
</html>