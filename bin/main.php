<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Application as App;

$csvFile = __DIR__ . '/../dump/images.csv';
$downloadPath = __DIR__ . '/../dump/';

$app = new App($csvFile, $downloadPath);

$app->downloadImages();

