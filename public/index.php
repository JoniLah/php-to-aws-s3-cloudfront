<?php require("../includes/header.php"); ?>

<?php
    $objs = $s3->getIterator('ListObjects', [
        'Bucket' => $config['s3']['bucket']
    ]);

    // Make expiry date for files
    $file = 'uploads/flexbox.png';
    $cmd = $s3->getCommand('GetObject', [
        'Bucket' => $config['s3']['bucket'],
        'Key' => $file
    ]);
    $request = $s3->createPresignedRequest($cmd, '+10 seconds');
    $url = (string) $request->getUri();
?>



<h1>index</h1>


<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>
                Name
            </th>
            <th>
                Download
            </th>
            <th>
                View image
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($objs as $object): ?>
            <tr>
                <td>
                    <?php 
                        $object_name = explode('/', $object['Key']);
                        echo end($object_name);
                    ?>
                </td>
                <td><a href="<?php echo $url; ?>" download="<?php echo $url; ?>">Download</a></td>
                <td><a href="<?php echo $s3->getObjectUrl($config['s3']['bucket'], $object['Key']); ?>">View</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



<?php require("../includes/footer.php"); ?>