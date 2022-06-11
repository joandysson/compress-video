<?php

require 'vendor/autoload.php';
use Compress\Compress;

$result = (new Compress(sprintf('%s%s',__DIR__,'/files')))->exec();

echo $result;
