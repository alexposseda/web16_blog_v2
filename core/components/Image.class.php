<?php

    namespace core\components;

    class Image{
        protected $_sourceImage;
        protected $_config;
        protected $_thumbs = [];

        public function __construct($sourceImageFileName){
            $this->_config = require_once 'core/config/main.php';
            if(!file_exists($sourceImageFileName)){
                throw new \Exception('file ['.$sourceImageFileName.'] not found!');
            }
            $this->_sourceImage = $sourceImageFileName;
        }

        public function createThumbs($type = 'base'){
            $thumbsSizes = $this->_config['images']['sizes'][$type];
            $extension = pathinfo($this->_sourceImage, PATHINFO_EXTENSION);
            switch($extension){
                case 'jpg':
                case 'jpeg':
                    $originalImage = imagecreatefromjpeg($this->_sourceImage);
                    break;
                case 'png' :
                    $originalImage = imagecreatefrompng($this->_sourceImage);
                    break;
            }
            $originalSize = getimagesize($this->_sourceImage);
            $k = $originalSize[0]/$originalSize[1];
            foreach($thumbsSizes as $destinationSize){
                $thumb = imagecreatetruecolor($destinationSize[0], $destinationSize[1]);
                $coordinates = [
                    $originalSize[0]/2-$destinationSize[0]/2,
                    $originalSize[1]/2-$destinationSize[1]/2,
                ];
                imagecopyresampled($thumb, $originalImage, 0,0,0,0, $destinationSize[0], $destinationSize[0]*$k, $originalSize[0], $originalSize[1]);
                $name = $this->_config['images']['storage_path'].time().'_'.$destinationSize[0].'x'.$destinationSize[1].'.'.$extension;
                switch($extension){
                    case 'jpg':
                    case 'jpeg':
                        imagejpeg($thumb, $name);
                        break;
                    case 'png' :
                        imagepng($thumb, $name);
                        break;
                }
                $this->_thumbs[] = $name;
                imagedestroy($thumb);
            }
            imagedestroy($originalImage);
        }
    }