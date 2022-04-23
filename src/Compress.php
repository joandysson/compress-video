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
                $output = sprintf('%s%s%s/%s',__DIR__, $this->path, self::COMPRESSED, pathinfo($file)['basename']);

                exit($output);
                $command = sprintf('ffmpeg -i %s -b:v %s -bufsize %s %s', $file, getenv('BITRATE'), getenv('BITRATE'), $output);
                exec($command);
            }catch(\Throwable $t){
                echo $t->getMessage();
            }
        }
    }

}
