<?php

require 'vendor/autoload.php';
use Compress\Compress;

echo (new Compress(sprintf('%s%s',__DIR__,'/files')))->exec();
