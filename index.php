<?php
	session_start();

	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] === "POST"){

		if($_POST['submit']==="Submit"){
			$firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
			$lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
			$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			$sanEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
			$category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
			$checkboxes=filter_input(INPUT_POST, 'event', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

			

				$subject = "Welcome!";
				$message = emailBody($firstName, $lastName, $category, $checkboxes);
				$headers = "Content-type: text/html\r\n";
			
			
			

			if(!empty($firstName) && !empty($lastName) && !empty($sanEmail)){

				if (checkIfExists($sanEmail)){
					$_SESSION['message'] = "that email already exists";
					header("location: index.php");
					exit;
				} else{

					if(addUser($firstName, $lastName, $sanEmail)){

						// mail()
						if(mail($sanEmail, $subject, $message, $headers)){

							$_SESSION['message'] = "You've been signed up!";
							header("location: index.php");
							exit;
						} else {
							$_SESSION['message'] = "There has been an error sending the email.";
							header("location: index.php");
							exit;
						}

					} else{

						$_SESSION['message']="There has been an error signing you up.";
						header("location: index.php");
						exit;
					}

				}

		}
	}

}

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Sign Up Form</title>

		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    	<meta http-equiv="x-ua-compatible" content="ie=edge">

    	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="css/styles.css">

	</head>
	<body>

		

		

		<form id="form" class="col-sm-6 col-sm-offset-3 col-xs-12" method="POST" action="index.php">


			<h1 id="header" class="text-center">Email Sign Up Form</h1>

			<?php 
				if(isset($_SESSION['message'])){
					flashMessage();	
					unset($_SESSION['message']);
			}
			
			?>

			
			<label for="firstName" >First Name</label>
			<div class="form-group">
				<input type="text" id="firstName" name="firstName" class="form-control borderReg" />
			</div>

			<label for="lastName">Last Name</label>
			<div class="form-group">
				<input type="text" id="lastName" name="lastName" class="form-control borderReg" />			 
			</div>

			<label for="email">Email</label>
			<div class="form-group">
				<input type="email" id="email" name="email" class="form-control borderReg" />
			  
			</div>

			<div id="select">Tell us what type of events you're inerested in:</div>

			<div>
				<select name="category">
					<option value="none" >Please select an event category</option>
					<option value="sport" >Sporting Events</option>
					<option value="concert" >Concerts</option>
					<option value="food" >Food & Wine Festivals</option>
					<option value="other">Other Events</option>					
				</select>
			</div>

			

			<label id="checkboxLabel" for="events">Check each type of event you'd like us to keep you informed about</label>
			<section id="events">
			
			
			</section>
			<div class="form-group">
				<input class="btn btn-default btn-lg" name="submit" type="submit" class="form-control" value="Submit" />
			</div>


		</form>


			
    
		  






		<!-- Latest compiled and minified JavaScript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="signUpJs.js"></script>

	</body>
</html>




