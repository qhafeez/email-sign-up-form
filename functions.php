<?php 

	try{
	// $db = new PDO("mysql:host=localhost;dbname=FreshCuts;port=8889","root","root");
	$db = new PDO("mysql:host=mysql.qhafeezdomain.dreamhosters.com;dbname=signupform;port=3306","qhafeezdomaindre","3XLjSbBZ");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
} catch(Exception $e) {
	echo $e->getMessage();
	exit;
}



	function addUser($firstName, $lastName, $email){
		
		global $db;

		try{

			$sql = "INSERT INTO registered(first_name, last_name, email) VALUES (:first_name, :last_name, :email)";
			$result=$db->prepare($sql);
			$result->bindParam(":first_name", $firstName, PDO::PARAM_STR);
			$result->bindParam(":last_name", $lastName, PDO::PARAM_STR);
			$result->bindParam(":email", $email, PDO::PARAM_STR);
			$result->execute();
			return true;

		} catch(Excpetion $e){

			$e->getMessage();
			return false;
		}


	}



	function checkIfExists($email){
		global $db;

		try{
			$sql = "SELECT * FROM registered WHERE email = :email";
			$result = $db->prepare($sql);
			$result->bindParam(":email", $email, PDO::PARAM_STR);
			$result->execute();
			if($result->rowCount()){
				return true; ///this means this email is already registered
			} 

		} catch(Exception $e){
			return false;
		}
	}


	function flashMessage(){
		if (isset($_SESSION["message"])){

			if ($_SESSION["message"] == "You've been signed up!"){
				$alertType = "alert-success";
				$message = "You've been signed up!";
			} else if($_SESSION["message"] == "that email already exists") {
				$alertType = "alert-error";
				$message = "There email already exists!";
			} else if($_SESSION["message"] == "There has been an error sending the email."){
				$alertType = "alert-error";
				$message = "There has been an error sending the email.";
			} else {
				$alertType = "alert-error";
				$message = "There has been an error signing you up.";
			}
			
		echo	"<div class=\"alert $alertType alert-dismissible\" role=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>$message</div>";
			
			
		
		}
	}

	function category($category){

		$catName="";

		switch($category):

			case "sport":
				$catName = "Sporting Events";
				return $catName;
				break;
			case "concert":
				$catName = "Concerts";
				return $catName;
				break;
			case "food":
				$catName = "Food & Wine Festivals";
				return $catName;
				break;
			case "other":
				$catName = "Other";
				return $catName;
				break;
			endswitch;

	}

	function emailBody($firstName, $lastName, $category, $checkboxes){

		$catName = category($category);

		$message="";
		$message.= "<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html charset=UTF-8\" />
    <style>
      .topTable{
      	width:100%;
        background-color:yellow;
        height:50px;
     }
      .outerMost{
      	width: 100%;
      	background-color:darkgray;
      }
     .inner{
      	background-color:white;
       	width: 95%;
      	margin-left:2.5%;
        margin-right:2.5%;
      }
      
      .heading{
      	text-align:center;
        font-size:1.2em;
      }
      
      
      
      .body{
      	padding-left:20px;
        padding-right:20px;
      }   
      
      .space{
      	padding-top:20px;
      }
      
      .doubleSpace{
      	padding-top:40px;
      }
      
      .red{
      	height:30px;
        background-color:red;
      }
      
      .centerText{
      	text-align:center;
      }
      
      @media screen and (min-width:601px){
      	
        .outerMost{
          width:600px !important;
          
        }
        
        .topTable{
        	width: 600px !important;
        }
      
        .heading{
        	font-size:2em;
        }
        
      }
      
    </style>
  
  </head>
  
  <body>
    <table class=\"topTable\"><tr><td></td></tr></table>
    <table class=\"outerMost\">
      
      <tr><td >
        
        <table class=\"inner center\">
          <tr><td class=\"heading\">Event Notification Reminders</td></tr>
          	<tr><td class=\"body doubleSpace\">Hello Qasim Hafeez,</td></tr>
			<tr><td class=\"body space\">Thank you for signing up with us. We will keep you informed of the following:</td></tr>";

            $message.= "<tr><td class=\"body doubleSpace centerText\">" . $catName . "</td></tr>";
          	$message.= "<tr><td class=\"body space centerText\">";
          	foreach($checkboxes as $checkbox){
          		$message.= "&bull; $checkbox <br>";	
          	}
          	$message.= "</td></tr></table></td></tr></table><table class=\"topTable\"><tr><td></td></tr></table>
  
  </body>

</html>";

		return $message;

	}

	




?>