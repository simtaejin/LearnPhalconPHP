<?php
date_default_timezone_set('Asia/Seoul');

$config = new \Phalcon\Config([
    'db' =>[
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'test1234',
        'dbname' => 'phalcon_exam',
    ],
    'environment' => 'staging'
]);

$api = new \Phalcon\Config([
    'fb' => [
        'appId' => '123',
        'appSecret' => '345'
    ],
    'asw' => [
        'cloudfrontPem' => 'file.pem',
        'cloudfrontKey' => 'A$432423423'
    ]
]);
