
			$(function(){


			$("#form").on("submit", function(e){
				
				var $firstName = $("#firstName");
				var $lastName = $("#lastName");
				var $email = $("#email");
				var $checked = $("input:checked");
				var $checkbox = $(".checkbox");

				console.log($checked);

					if($firstName.val() ===""){
						e.preventDefault();
						addErrorLabel($firstName, "Please Enter Your First Name");
						addErrorBorder($firstName);
					} else {
						$firstName.parent().prev().removeClass("error").html("First Name");
						addRegBorder($firstName);
					}

					if($lastName.val() ===""){
						e.preventDefault();
						addErrorLabel($lastName, "Please Enter Your Last Name");
						addErrorBorder($lastName);
						
					} else {
						$lastName.parent().prev().removeClass("error").html("Last Name");
						addRegBorder($lastName);
					}

					if($email.val() === ""){
						e.preventDefault();
						addErrorLabel($email, "Please enter your email address");
						addErrorBorder($email);
						
					} else{
						$email.parent().prev().removeClass("error").html("Email");
						addRegBorder($email);
					}

					if($checked.length < 1){
						e.preventDefault();
						addErrorLabel($checkbox, "You must select at least one event");
					} else {
						addRegLabel($checkbox, "Check each event you'd like us to keep you informed about");
					}



					
			});

			$("select").change(function(){
				
				if($("#checkboxLabel:hidden")){
					$("#checkboxLabel").show();
					console.log("hello");
				}
				
				var $val = $(this).val();

				
				var $url = "checkbox.html";
				
				
				
				switch($val){
					
					case "sport":

							$(".eventGroup").remove();
							$("#events").load($url+" #sport").hide().fadeIn("slow");
							break;

					case "concert":
							$(".eventGroup").remove();
							$("#events").load($url+" #concert").hide().fadeIn("slow");
							break;

					case "food":
							$(".eventGroup").remove();
							$("#events").load($url+" #food").hide().fadeIn("slow");
							break;
					
					case "other":
							$(".eventGroup").remove();
							$("#events").load($url+" #other").hide().fadeIn("slow");
							break;
					
					case "none":
							$(".eventGroup").remove();
							$("#checkboxLabel").hide();
							break;

				} 
			});

			$(".alert").show("scale").effect("shake");

			function addErrorBorder(element){
				element.removeClass("borderReg");
				element.addClass("borderError");
			}	

			function addRegBorder(element){
				element.removeClass("borderError");
				element.addClass("borderReg");
			}

			function addErrorLabel(element, message){
				element.parent().prev().addClass("error").html(message);
			}

			function addRegLabel(element, message){
				element.parent().prev().removeClass("error").html(message);
			}

	});


