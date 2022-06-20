<?php
require('constant.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact Us</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="component/jquery/jquery-3.2.1.min.js"></script>
	<script>
	$(document).ready(function (e){
		$("#frmContact").on('submit',(function(e){
			e.preventDefault();
			$("#mail-status").hide();
			$('#send-message').hide();
			$('#loader-icon').show();
			$.ajax({
				url: "contact.php",
				type: "POST",
				dataType:'json',
				data: {
				"name":$('input[name="name"]').val(),
				"email":$('input[name="email"]').val(),
				"phone":$('input[name="phone"]').val(),
				"content":$('textarea[name="content"]').val(),
				"g-recaptcha-response":$('textarea[id="g-recaptcha-response"]').val()},				
				success: function(response){
				$("#mail-status").show();
				$('#loader-icon').hide();
				if(response.type == "error") {
					$('#send-message').show();
					$("#mail-status").attr("class","error");				
				} else if(response.type == "message"){
					$('#send-message').hide();
					$("#mail-status").attr("class","success");							
				}
				$("#mail-status").html(response.text);	
				},
				error: function(){} 
			});
		}));
	});
	</script>

	<style>
	.label {margin: 2px 0;}
	.field {margin: 0 0 20px 0;}	
		.content {width: 960px;margin: 0 auto;}
		h1, h2 {font-family:"Georgia", Times, serif;font-weight: normal;}
		div#central {margin: 40px 0px 100px 0px;}
		@media all and (min-width: 768px) and (max-width: 979px) {.content {width: 750px;}}
		@media all and (max-width: 767px) {
			body {margin: 0 auto;word-wrap:break-word}
			.content {width:auto;}
			div#central {	margin: 40px 20px 100px 20px;}
		}
		body {font-family: 'Helvetica',Arial,sans-serif;background:#ffffff;margin: 0 auto;-webkit-font-smoothing: antialiased;  font-size: initial;line-height: 1.7em;}	
		input, textarea {width:100%;padding: 15px;font-size:1em;border: 1px solid #A1A1A1;	}
		button {
			padding: 12px 60px;
			background: #5BC6FF;
			border: none;
			color: rgb(40, 40, 40);
			font-size:1em;
			font-family: "Georgia", Times, serif;
			cursor: pointer;	
		}
		#message {  padding: 0px 40px 0px 0px; }
		#mail-status {
			padding: 12px 20px;
			width: 100%;
			display:none; 
			font-size: 1em;
			font-family: "Georgia", Times, serif;
			color: rgb(40, 40, 40);
		}
	  .error{background-color: #F7902D;  margin-bottom: 40px;}
	  .success{background-color: #48e0a4; }
		.g-recaptcha {margin: 0 0 25px 0;}	  
	</style>
	<script src='https://www.google.com/recaptcha/api.js'></script>	
</head>
<body>

<div id="central">
                    <div class="content">
                        <div id="message">
                            <form id="frmContact" action="" method="POST" novalidate="novalidate">

                                <div class="label">Fornavn:</div>
                                <div class="field">
            
                                    <input type="text" id="firstname" name="firstname" placeholder="Fornavn.." width="5"
                                        title="Please enter your name" class="required firstname" aria-required="true" required>
                                </div>
                                <div class="label">Efternavn:</div>
                                <div class="field">
            
                                    <input type="text" id="lastname" name="lastname" placeholder="Efternavn.."
                                        title="Please enter your name" class="required lastname" aria-required="true" required>
            
                                </div>
                                <div class="label">Virksomehedens navn og adresse:</div>
                                <div class="field">
            
                                    <input type="text" id="company" name="companyname"
                                        placeholder="Virksomehedens navn og adresse.." title="Please enter your name"
                                        class="required companyname" aria-required="true" required>
                                </div>
            
                                <div class="label">Email:</div>
                                <div class="field">
            
                                    <input type="text" id="email" name="email" placeholder="Email.." title="Please enter your name"
                                        class="required email" aria-required="true" required>
                                </div>
            
                                <div class="label">Telefon nummer:</div>
                                <div class="field">
                                    <input type="text" id="phone" name="phone" placeholder="Nummer.."
                                        title="Please enter your phone number" class="required phone" aria-required="true" required>
                                </div>
                                <label>Besked:</label>
                                <div class="field">
                                    <textarea name="content" id="comment-content" class="input-field" cols="40" rows="4"
                                        placeholder="Her kan du for eksempel skrive hvad i laver og hvad i kan tilbyde, eller man kan stille et spørgsmål.."></textarea>
                                </div>
            
            
                                <div>
                                    <input type="submit" data-sitekey="<?php echo SITE_KEY; ?>" data-callback='onSubmit' data-action='submit' id="send-message" name="send" class="btn-submit g-recaptcha" value="Send" />
            
                                    <div id="statusMessage">
                                        <?php
                                            if (! empty($message)) {
                                                ?>
                                        <p class='<?php echo $type; ?>Message'>
                                            <?php echo $message; ?>
                                        </p>
                                        <?php
                                            }
                                            ?>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div><!-- content -->
</div><!-- central -->	
</body>
</html>