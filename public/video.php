<?php require("../includes/header.php"); ?>

<?php
    $object = "uploads/VID_20180409_142146.mp4";
    $stream_host_url = "{$config['cloudfront']['url']}";
    $expiration = new DateTime("+5 seconds");

    $url = $cloudfront->getSignedUrl([
        'url' => $stream_host_url."/".$object,
        'expires' => $expiration->getTimestamp(),
        'private_key' => "../{$config['cloudfront']['private_key']}",
        'key_pair_id' => $config['cloudfront']['key_pair_id']
    ]);
?>

<video width="600" controls>
    <source src="<?php echo $url; ?>" type="video/mp4">
</video>

<?php require("../includes/footer.php"); ?>