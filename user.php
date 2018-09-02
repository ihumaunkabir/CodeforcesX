<!DOCTYPE html>
<html>
<head>
	<title>CodeforcesX | Explore...</title>

	<link rel="stylesheet" type="text/css" href="main.css">
  	<link rel="stylesheet" type="text/css" href="/am/css/main.css">
  	<!-- Latest compiled and minified CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
   
  	<!-- Optional theme -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
   
  	<link rel="stylesheet" href="styles.css" >
   
  	<!-- Latest compiled and minified JavaScript -->
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<center>
	<div>
		<h4>CodeforcesX, A simple tool to see contest list and user information</h4>
		<p>Made with &#10084; by <a href="https://oasiscse.github.io">Humaun Kabir</a></p>
		<br>
		<a href="index.php">Back to Home</a>
		<br>
		<br>
	</div>
	<div>
		<form class="form-inline" method="post">
			  <div class="form-group mx-sm-3 mb-2">
			    <input type="text" class="form-control" id="cfhandle" placeholder="cf handle" name="handle">
			  </div>

 				<button type="submit" class="btn btn-primary mb-2" name="show">Show</button>

		</form>
	</div>

	<?php

		if (isset($_POST['show'])) {
			
			if(empty($_POST['handle'])){
				throw new Exception("Codeforces handle cann't be empty :)", 1);
				
			}
				$user = $_POST['handle'];
				$url = "https://codeforces.com/api/user.info?handles=".$user;
				$datainjson = file_get_contents($url);
				$jsondata = json_decode($datainjson,true);

				foreach ($jsondata['result'] as $user) {

	?>


	<div>
		<div><br><br><?php echo '<img class="propic" src="'.$user['avatar'].'"/>'; ?><br><br></div>
		<form class="form-horizontal col-md-6 col-md-offset-3">
		<table class="table table-striped">
			  
			    <tr>
			    
			      <td>Name</td>
			    
			      <td><?php 
			      if(empty($user['firstName']) && empty($user['lastName'])){
			      	echo "User didn't add this info on codeforces";
			      }
			      else{ echo $user['firstName']." ".$user['lastName']; } ?></td>
			    
			    </tr>

			    <tr>
			    
			      <td>Mailing Address</td>
			      <td><?php 
			      if(empty($user['organization']) && empty($user['city']) && empty($user['country'])){
			      	echo "User didn't add this info on codeforces";
			      }
			      else { echo $user['organization']."<br>".$user['city'].",".$user['country']; } ?></td>
			    
			    </tr>

			    <tr>
			      <td>Rank and Rating</td>
			      <td><?php echo $user['rank'].",".$user['rating']; ?></td>
			    </tr>
			    
			    <tr>
			      <td>Max. Rank & Rating</td>
			      <td><?php echo $user['maxRank'].",".$user['maxRating']; ?></td>
			    </tr>

			    <tr>
			      <td>Contribution</td>
			      <td><?php echo $user['contribution']; ?></td>
			    </tr>

			    <tr>
			      <td>On codeforces for</td>
			      <td><?php 

			      	$now = time();
			      	$yr = $user['registrationTimeSeconds'];
			      	echo round(($now  - $yr) / 31540000)." year(s)";

			      ?></td>
			    </tr>
		</table>
		</form>
		<br>
	</div>
		
		<?php 
			
			}
		}	

		?>
<div><br></div>
</center>
</body>
</html>