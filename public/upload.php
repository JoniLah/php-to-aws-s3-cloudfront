<?php use Aws\S3\Exception\S3Exception; ?>

<?php require("../includes/header.php"); ?>

<?php

    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $name = $file['name'];
        $tmp_name = $file['tmp_name'];

        $ext = explode('.', $name);
        $ext = strtolower(end($ext));

        // Temporary data
        $key = md5(uniqid());
        $temp_file_name = "{$key}.{$ext}";
        $temp_file_path = "uploads/{$temp_file_name}";

        move_uploaded_file($tmp_name, $temp_file_path);

        try {
            $s3->putObject([
                'Bucket' => $config['s3']['bucket'],
                'Key' => "uploads/{$name}",
                'Body' => fopen($temp_file_path, 'rb'),
                'ACL' => 'public-read'
            ]);
        } catch (S3Exception $e) {
            die('There was an error uploading files. ' . $e->getMessage());
        }

        unlink($temp_file_path);
    }


?>



<h1>Upload</h1>

<form method="post" enctype="multipart/form-data" class="form-inline">

    <div class="form-group">
        <input type="file" name="file">
    </div>

    <div class="form-group">
        <input type="submit" value="Upload" class="btn btn-primary">
    </div>

</form>

<p></p><p></p>

<div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
    0
  </div>
</div>



<?php require("../includes/footer.php"); ?>