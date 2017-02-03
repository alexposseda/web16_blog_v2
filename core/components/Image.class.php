<?php

    namespace core\components;

    class Image{
        protected $_sourceImage;
        protected $_sourceImageName;
        protected $_config;
        protected $_thumbs = [];
        protected $_path;
        protected $_extension;

        public function __construct($sourceImageFileName){
            $c = require_once 'core/config/main.php';
            $this->_config = $c['image'];
            if(empty($this->_config)){
                throw new \Exception('Config for Image not found!');
            }

            $this->_sourceImage = $this->createImageFrom($sourceImageFileName);

            $this->_path = pathinfo($sourceImageFileName, PATHINFO_DIRNAME);
            $this->_sourceImageName = pathinfo($sourceImageFileName, PATHINFO_BASENAME);
            $this->_extension = pathinfo($sourceImageFileName, PATHINFO_EXTENSION);
        }

        public function createThumbs($type = 'base'){
            $thumbsSizes = $this->_config['sizes'][$type];

            foreach($thumbsSizes as $newSize){
                $this->createNewImage($newSize);

//                $thumb = imagecreatetruecolor($destinationSize[0], $destinationSize[1]);
//                $coordinates = [
//                    $originalSize[0]/2-$destinationSize[0]/2,
//                    $originalSize[1]/2-$destinationSize[1]/2,
//                ];
//                imagecopyresampled($thumb, $originalImage, 0,0,0,0, $destinationSize[0], $destinationSize[0]*$k, $originalSize[0], $originalSize[1]);
//                $name = $this->_config['images']['storage_path'].time().'_'.$destinationSize[0].'x'.$destinationSize[1].'.'.$extension;
//                switch($extension){
//                    case 'jpg':
//                    case 'jpeg':
//                        imagejpeg($thumb, $name);
//                        break;
//                    case 'png' :
//                        imagepng($thumb, $name);
//                        break;
//                }
//                $this->_thumbs[] = $name;
//                imagedestroy($thumb);
            }
        }

        protected function createImageFrom($pathToImage){
            if(!file_exists($pathToImage)){
                throw new \Exception('file ['.$pathToImage.'] not found!');
            }
                $image = null;
                switch($this->_extension){
                    case 'jpg':
                    case 'jpeg':
                        $image = imagecreatefromjpeg($pathToImage);
                        break;
                    case 'png' :
                        $image = imagecreatefrompng($pathToImage);
                        break;
                }
            return $image;
        }

        protected function createNewImage($config){
            $newImage = imagecreatetruecolor($config['width'], $config['height']);
            if(!$newImage){
                throw new \Exception('Cannot create new image...');
            }
            $origW = imagesx($this->_sourceImage);
            $origH = imagesy($this->_sourceImage);
            $newW = floor($origW * ($config['height'] / $origH));
            $newH = $config['height'];

            imagecopyresampled($newImage, $this->_sourceImage, 0,0,0,0, $newW, $newH, $origW, $origH);
            $this->saveImage($newImage, $config['prefix']);
        }

        protected function saveImage($image, $prefix = ''){
            $imageName = $prefix.$this->_sourceImageName.'.'.$this->_extension;
            $res = false;
            switch($this->_extension){
                case 'jpg':
                case 'jpeg':
                    $res = imagejpeg($image, $this->_path.$imageName);
                    break;
                case 'png' :
                    $res = imagepng($image, $this->_path.$imageName);
                    break;
            }
            if(!$res){
                throw new \Exception('Cannot save new image...');
            }

            $this->_thumbs[] = $imageName;
            imagedestroy($image);
        }
    }