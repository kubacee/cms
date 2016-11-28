<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 16.02.16
 * Time: 15:49
 */
class Tool
{
    /**
     * Decode csv and return params in array.
     * @param $configFile
     * @return array
     */
    public function getCsvParams($configFile)
    {
        $line_of_text = array();
        $file_handle = fopen($configFile, 'r');

        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 1024);
        }

        fclose($file_handle);

        return $line_of_text;
    }

    public function parseToUrlName($string)
    {
        return $this->generateDirName($string);
    }

    public function generateDirName($string)
    {
        return str_replace(' ', '_', $string);
    }

    public function getCsvParams2($csvfile)
    {
        $csv = Array();
        $rowcount = 0;
        if (($handle = fopen($csvfile, "r")) !== FALSE) {
            $max_line_length = defined('MAX_LINE_LENGTH') ? MAX_LINE_LENGTH : 10000;
            $header = fgetcsv($handle, $max_line_length);
            $header_colcount = count($header);
            while (($row = fgetcsv($handle, $max_line_length)) !== FALSE) {
                $row_colcount = count($row);
                if ($row_colcount == $header_colcount) {
                    $entry = array_combine($header, $row);
                    $csv[] = $entry;
                }
                else {
                    error_log("csvreader: Invalid number of columns at line " . ($rowcount + 2) . " (row " . ($rowcount + 1) . "). Expected=$header_colcount Got=$row_colcount");
                    return null;
                }
                $rowcount++;
            }
            //echo "Totally $rowcount rows found\n";
            fclose($handle);
        }
        else {
            error_log("csvreader: Could not read CSV \"$csvfile\"");
            return null;
        }
        return $csv;
    }

    /**
     * Encode params from url.
     *
     * @return mixed
     */
    public function getParamsPreviousPage()
    {
        $url = parse_url($_SERVER['HTTP_REFERER']);

        // Encode params from url.
        $params = (explode('/', $url['path']));

        array_shift($params);

        // ~

        return $params;
    }

    /**
     * PNG ALPHA CHANNEL SUPPORT for imagecopymerge();
     * This is a function like imagecopymerge but it handle alpha channel well!!!
     **/
    public function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
        $opacity=$pct;
        // getting the watermark width
        $w = imagesx($src_im);
        // getting the watermark height
        $h = imagesy($src_im);

        // creating a cut resource
        $cut = imagecreatetruecolor($src_w, $src_h);
        // copying that section of the background to the cut
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);

        // placing the watermark now
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $opacity);
    }

    public function mergeImage($newImage, $copyImagePath, $dst_x, $dst_y, $src_x, $src_y, $width, $height, $opacity)
    {
        $tmpImage = imagecreatefrompng($copyImagePath);

//        imagealphablending($newImage, true);
//        imagesavealpha($newImage, true);

        $this->imagecopymerge_alpha($newImage, $tmpImage, $dst_x, $dst_y, $src_x, $src_y, $width, $height, $opacity);

        imagedestroy($tmpImage);
    }

    public function generateEmptyImage($width, $height)
    {
        $image = imagecreatetruecolor($width, $height);
        $color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image,0,0,$width,$height,$color);
//        imagefill($image, 0, 0, $color);

        return $image;
    }

    public function saveNewImage($image, $filePath)
    {
        imagesavealpha($image, true);
        imagepng($image, $filePath);

        imagedestroy($image);
    }

    public function createDirectory($dir)
    {
        if (!is_dir($dir)) {
            $old = umask(0);
            mkdir($dir, 0777, true);
            umask($old);
        }
    }

    public function generateSlug($text) {
        return $this->createAlias($text);
    }

    public function createAlias($name, $replacement = '-') {
        $replace = array('Ą', 'ą', 'Ć', 'ć', 'Ę', 'ę', 'Ł', 'ł', 'Ń', 'ń', 'Ó', 'ó', 'Ś', 'ś', 'Ź', 'ź', 'Ż', 'ż');
        $subject = array('a', 'a', 'c', 'c', 'e', 'e', 'l', 'l', 'n', 'n', 'o', 'o', 's', 's', 'z', 'z', 'z', 'z');

        $alias = '';
        $name  = strtolower(str_replace($replace, $subject, $name));
        $nameLength = strlen($name);
        for($i = 0; $i < $nameLength; $i++) {
            if(!$this->isLetter($name[$i]) && !$this->isNumber($name[$i])) {
                if($i > 0 && strlen($alias) > 0 && $alias[strlen($alias) - 1] != $replacement)
                    $alias = $alias . $replacement;
            } else
                $alias = $alias . $name[$i];
        }

        return trim($alias, $replacement);
    }

    function isLetter($c) {
        return ($c >= 'A' && $c <= 'Z') || ($c >= 'a' && $c <= 'z');
    }

    function isNumber($c) {
        return $c >= '0' && $c <= '9';
    }


    public function getPreviousRoute()
    {
        return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    }

    function deleteFiles($target)
    {
        if(!is_link($target) && is_dir($target))
        {
            // it's a directory; recursively delete everything in it
            $files = array_diff( scandir($target), array('.', '..') );
            foreach($files as $file) {
                $this->deleteFiles("$target/$file");
            }
            rmdir($target);
        }
        else
        {
            // probably a normal file or a symlink; either way, just unlink() it
            unlink($target);
        }
    }
}