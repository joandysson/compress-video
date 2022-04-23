<?php

require 'vendor/autoload.php';
use Compress\Compress;

// 	$command = "ffmpeg -i $file -vcodec libx264 -crf 32 $newFile";
// 	exec($command);
// }

// Bitrate	Format
// 350k	240p
// 700k	360p
// 1200k	480p
// 2500k	720p
// 5000k	1080p


// $command = "/usr/local/bin/ffmpeg -i $video -s $resolution output2.mp4";
// system($command);


print_r((new Compress(sprintf('%s%s',__DIR__,'/files')))->exec());
