<?php

    use Aws\S3\S3Client;
    use Aws\CloudFront\CloudFrontClient;

    require '../vendor/autoload.php';
    $config = require 'configuration.php';

    $s3 = new S3Client([
        'version' => $config['s3']['version'],
        'region' => $config['s3']['region'],
        'credentials' => [
            'key' => $config['s3']['key'],
            'secret' => $config['s3']['secret']
        ]
    ]);

    $cloudfront = new CloudFrontClient([
        'version' => $config['s3']['version'],
        'region' => $config['s3']['region'],
    ]);

?>