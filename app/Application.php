<?php

namespace App;

class Application {
    public $imgArray = array();
    public $downloadPath;

    function __construct($csvFileName, $downloadPath)
    {
        $file = fopen($csvFileName,"r");
        echo $file;
        while(!feof($file)) {
            array_push($this->imgArray, fgetcsv($file)[0]);
        }
        $this->downloadPath = $downloadPath;
    }

    public function downloadImages() {

        foreach(array_filter($this->imgArray) as $key => $value) {

            switch(exif_imagetype($value)) {
                case 1:
                    $imgType = ".gif";
                break;
                case 2:
                    $imgType = ".jpg";
                break;
                case 3:
                    $imgType = ".png";
                break;
                default:
                $imgType = ".jpg";
            }

            $imgName = explode("/", $value);
            $imgName = time() . "_" . end($imgName) . $imgType;
            $imgName = $this->downloadPath . $imgName;
            
            $fileSuccess = file_put_contents($imgName, file_get_contents($value));

            if($fileSuccess) {
                echo "\n Downloaded {$value}";
            } else {
                echo "\nDownload Failed.";
            }
        }
    }
}