<?php
if(isset($_GET['edit'])){
	$statement = $DB->prepare("select * from `pages` where `id` = ? ");
	$statement->execute([$_GET['edit']]);
	$_page = $statement->fetchAll()[0];
	if(empty($_page)){
		EXIT("Error 404");
	}
	$Errors = "";
	$featured_image = $_page['featured_image'];
	if(isset($_FILES['featured_image']) && !empty($_FILES['featured_image']['name'])){
		$featured_image = $_FILES['featured_image']["name"];
		$target_dir = __DIR__."/../../images/";
		$target_file = $target_dir . basename($_FILES["featured_image"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["featured_image"]["tmp_name"]);
		    if($check !== false) {
		        $Errors = "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        $Errors = "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    $Errors = "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["featured_image"]["size"] > 500000) {
		    $Errors = "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    $Errors = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    $Errors = "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (!move_uploaded_file($_FILES["featured_image"]["tmp_name"], $target_file)) {
		        $Errors = "Sorry, there was an error uploading your file.";
		    }
		}



		$statement = $DB->prepare("update `pages`
		set
			`name` = ?,
			`title` = ?,
			`slogan` = ?,
			`description` = ?,
			`content` = ?,
			`notes` = ?,
			`robots` = ?,
			`featured_image` = ?
		where `id` = ? ");
		$statement->execute([
			$_POST['name'],
			$_POST['title'],
			$_POST['slogan'],
			$_POST['description'],
			base64_encode($_POST['content']),
			base64_encode($_POST['notes']),
			implode($_POST['robots'],","),
			$featured_image,
			$_GET['edit']
		]);

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
	            <strong class="card-title">Edit Pages</strong>
	        </div>
	        <div class="card-body">

				<form class="form-horizontal" method="post" enctype="multipart/form-data">

					<?= $Errors; ?>

					<div class="row form-group">
						<div class="col col-md-3">
							<label for="text-input" class=" form-control-label">featured_image</label>
						</div>
						<div class="col-12 col-md-9">
							<input type="file" id="featured_image" name="featured_image" placeholder="featured_image" value="<?= $_page['featured_image']; ?>" class="form-control">
						</div>
					</div>

					<div class="row form-group">
						<div class="col col-md-3">
							<label for="text-input" class=" form-control-label">Page name</label>
						</div>
						<div class="col-12 col-md-9">
							<input type="text" id="name" name="name" placeholder="name" value="<?= $_page['name']; ?>" class="form-control">
						</div>
					</div>

					<div class="row form-group">
						<div class="col col-md-3">
							<label for="text-input" class=" form-control-label">Page title</label>
						</div>
						<div class="col-12 col-md-9">
							<input type="text" id="title" name="title" placeholder="title" value="<?= $_page['title']; ?>" class="form-control">
						</div>
					</div>

					<div class="row form-group">
						<div class="col col-md-3">
							<label for="text-input" class=" form-control-label">Page slogan</label>
						</div>
						<div class="col-12 col-md-9">
							<input type="text" id="slogan" name="slogan" placeholder="slogan" value="<?= $_page['slogan']; ?>" class="form-control">
						</div>
					</div>

					<div class="row form-group">
						<div class="col col-md-3">
							<label for="text-input" class=" form-control-label">Page description</label>
						</div>
						<div class="col-12 col-md-9">
							<textarea id="description" name="description" placeholder="description" class="form-control"><?= ($_page['description']); ?></textarea>
						</div>
					</div>

					<div class="row form-group">
						<div class="col col-md-3">
							<label for="text-input" class=" form-control-label">Page content</label>
						</div>
						<div class="col-12 col-md-9">
							<textarea id="content" name="content" placeholder="content" class="form-control summernote"><?= base64_decode($_page['content']); ?></textarea>
						</div>
					</div>

					<div class="row form-group">
						<div class="col col-md-3">
							<label for="text-input" class=" form-control-label">Page notes</label>
						</div>
						<div class="col-12 col-md-9">
							<textarea id="notes" name="notes" placeholder="notes" class="form-control summernote"><?= base64_decode($_page['notes']); ?></textarea>
						</div>
					</div>

					<div class="row form-group">
						<div class="col col-md-3">
							<label for="text-input" class=" form-control-label">Page robots</label>
						</div>
						<div class="col-12 col-md-9">
							<?php $_page['robots'] = explode(",",$_page['robots']); ?>
							<select id="robots" name="robots[]" class="form-control standardSelect" data-placeholder="Choose robots..." multiple>
	                            <option value="index"<?php if(in_array('index',$_page['robots'])){echo " selected"; }?>>index</option>
	                            <option value="noindex"<?php if(in_array('noindex',$_page['robots'])){echo " selected"; }?>>no index</option>
	                        </select>
						</div>
					</div>

					<button type="submit" name="submit" class="btn btn-success">submit</button>

				</form>

	        </div>
	    </div>
	</div>
</div>
<?php
}else{
	?>
<div class="row">
	<div class="col-md-12">
	    <div class="card">
	        <div class="card-header">
	            <strong class="card-title">Pages</strong>
	        </div>
	        <div class="card-body">


				<table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
						$statement = $DB->prepare("select * from `pages` ");
						$statement->execute();
						$_pages = $statement->fetchAll();
						foreach ($_pages as $_page) {
						?>
                        <tr>
                            <td><?= $_page['id']; ?></td>
                            <td><?= $_page['name']; ?></td>
                            <td><?= $_page['title']; ?></td>
                            <td><a href="/admin/index.php?page=pages&edit=<?= $_page['id']; ?>" class="btn btn-info">edit</a></td>
                        </tr>
						<?php } ?>
                    </tbody>
                </table>


	        </div>
	    </div>
	</div>
</div>
<?php
}
