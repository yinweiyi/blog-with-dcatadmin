<?php
/**
 * Created by Idea.
 * User: wayee
 * Date: 2020/11/19
 * Time: 23:13
 */

namespace App\Services;

class ToolService
{
    /**
     * commend string
     *
     * @param $url
     * @param $width
     * @param $height
     * @return string
     */
    public function buildImageForUrl($url, $width = 0, $height = 0)
    {
        //wkhtmltoimage --width 1920 --height 1080 blog.ewayee.com  /www/blog/public/ewayee.jpg
        $command = 'wkhtmltoimage';
        if ($width) {
            $command .= ' --width=' . $width;
        }
        if ($height) {
            $command .= ' --height=' . $height;
        }
        $path = $this->getWkImageDir() . $url . '.jpg';

        $command .= ' ' . $url . ' ' . $path;

        $output = [];
        $result = exec($command , $output);

        dd($output, $result);
    }

    private function getWkImageDir()
    {
        $dir = storage_path('wk_images/');
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        return $dir;
    }

}
