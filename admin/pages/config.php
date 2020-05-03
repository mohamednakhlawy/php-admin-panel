<?php
$Errors = "";
if(isset($_POST['submit'])){
	$statement = $DB->prepare("update `config` set `value` = ? where `key` = 'contact_email' ");
	$statement->execute([$_POST['contact_email']]);

	$statement = $DB->prepare("update `config` set `value` = ? where `key` = 'head_code' ");
	$statement->execute([base64_encode($_POST['head_code'])]);

	if(empty($Errors)){
		$Errors = "success !";
	}

}
if(!empty($Errors)){
	$Errors = "<div id='Error_MSG'>".$Errors."</div>";
}
?>
<div class="row">
	<div class="col-md-12">
	    <div class="card">
	        <div class="card-header">
	            <strong class="card-title">Config</strong>
	        </div>
	        <div class="card-body">

				<form class="form-horizontal" method="post">

					<?= $Errors; ?>

					<div class="row form-group">
						<div class="col col-md-3">
							<label for="text-input" class=" form-control-label">Contact email</label>
						</div>
						<div class="col-12 col-md-9">
							<input type="text" id="contact_email" name="contact_email" placeholder="contact_email" value="<?= $config['contact_email']; ?>" class="form-control">
						</div>
					</div>

					<div class="row form-group">
						<div class="col col-md-3">
							<label for="text-input" class=" form-control-label">Add this Html code to Head Tag</label>
						</div>
						<div class="col-12 col-md-9">
							<textarea id="head_code" name="head_code" placeholder="head_code" class="form-control"><?= base64_decode($config['head_code']); ?></textarea>
						</div>
					</div>

					<button type="submit" name="submit" class="btn btn-success">submit</button>

				</form>


	        </div>
	    </div>
	</div>
</div>
