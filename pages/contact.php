<?php
$Errors = "";
if(isset($_POST['submit'])){
	$subject = 'Mail from contact from';
	$headers = 'From: '.$_POST['email'];

	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	  $Errors = $_POST['email']." is not a valid email address";
	}

	if(empty($_POST['message']) || empty($_POST['message']) || empty($_POST['message'])){
		$Errors = " All Fields is required";
	}

	if(empty($Errors)){
		$Errors = "success";
		if(!mail($config['contact_email'], $subject, "name: ".$_POST['message']." \n message: ".$_POST['message'], $headers)){
			$Errors = "Error";
		}
	}
}
if(!empty($Errors)){
	$Errors = "<div id='Error_MSG'>".$Errors."</div>";
}
?>

<div class="message-text">
	<?= base64_decode($page['content']); ?>
</div>

<br />

<?= $Errors; ?>

<form method="post" enctype="multipart/form-data">
	<div>
		<label>Name:</label> *
		<br />
		<input class="form-input-field" type="text" value="" name="name" size="40" />
		<br />
		<br />

		<label>Email Address:</label> *
		<br />
		<input class="form-input-field" type="text" value="" name="email" size="40" />
		<br />
		<br />

		<label>How can we help you?</label> *
		<br />
		<textarea class="form-input-field" name="message" rows="8" cols="38"></textarea>
		<br />
		<br />

		<input class="form-input-button" type="reset" name="resetButton" value="Reset" />
		<input class="form-input-button" type="submit" name="submit" value="Submit" />
	</div>
</form>

<br />
<div class="form-footer">
	<?= base64_decode($page['notes']); ?>
</div>
<br />
