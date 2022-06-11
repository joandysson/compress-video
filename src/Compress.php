<?php
namespace Compress;

class Compress {
    private const COMPRESSED = '/compressed';

    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    private function getAllFiles(): array
    {
        return array_filter(glob(sprintf('%s/*',$this->path)), fn($prop) => is_file($prop) ? true: false) ;
    }

    public function exec()
    {
        foreach($this->getAllFiles() as $file) {
            try{
                $outputFile = sprintf('%s%s/%s',pathinfo($file)['dirname'],self::COMPRESSED, pathinfo($file)['basename']);
                $command = sprintf('/usr/bin/ffmpeg -i %s -b:v %s -bufsize %s %s 2>&1', $file, getenv('BITRATE'), getenv('BITRATE'), $outputFile);

                static::compress($command);
            }catch(\Throwable $t){
                return $t->getMessage();
            }
        }

        return 'ok';
    }

    private static function compress($command)
    {
        while (ob_end_flush());
        $proc = popen($command, 'r');
        echo '<pre>';
        while (!feof($proc))
        {
            echo fread($proc, 4096);
            flush();
        }
        pclose($proc);
    }
}
