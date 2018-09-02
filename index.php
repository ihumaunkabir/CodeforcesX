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
		<a href="user.php">See User Information</a>
		<br>
	</div>

		<div>
		<form class="form-horizontal col-md-6 col-md-offset-3">
		<table class="table table-striped">
			<thead>
				<tr>
					<td scope="col"><strong>Contest</strong></td>
					<td scope="col"><strong>Status</strong></td>
					<td scope="col"><strong>Date</strong></td>
					<td scope="col"><strong>Type</strong></td>
				</tr>
			</thead>

	<?php

				
				$url = "https://codeforces.com/api/contest.list?gym=false";
				$datainjson = file_get_contents($url);
				$jsondata = json_decode($datainjson,true);
				$count = 0;

				foreach ($jsondata['result'] as $contest) {


	?>

			<tbody>
				<tr>
			    
			      <td scope="col"> <?php 
			      $la = "http://codeforces.com/contests/".$contest['id'];
			       echo "<a href ='".$la."'>".$contest['name']."</a>" 
			       ?> 
			 	  </td>

			      <td scope="col"> 
			      <?php 

			      	if ($contest['phase'] == "BEFORE" ) {
			      		echo  "Upcoming";
			      	}
			      	else if ($contest['phase'] == "CODING" ) {
			      		echo  "Running";
			      	}
			      	else if ($contest['phase'] == "PENDING_SYSTEM_TEST" ) {
			      		echo  "System Test Pending";
			      	}
			      	else if ($contest['phase'] == "SYSTEM_TEST" ) {
			      		echo  "System Testing";
			      	}
			      	else if ($contest['phase'] == "FINISHED" ) {
			      		echo  "Ended";
			      	}

			      ?> </td>
			      <td scope="col"> <?php 
			      $timestamp = $contest['startTimeSeconds'];
					$datetimeFormat = 'Y-m-d H:i:s';

					$date = new \DateTime();
					
					$date = new \DateTime('now', new \DateTimeZone('Asia/Dhaka'));
					$date->setTimestamp($timestamp);
					echo $date->format($datetimeFormat);
								      ?>
			       </td>
			      <td scope="col"> <?php echo $contest['type'] ?> </td>

			    </tr>

			</tbody>
			    
		<?php 
			$count++;
			}
		?>

		</table>
		</form>
		<br>
	</div>
		


<div><br></div>
</center>
</body>
</html>