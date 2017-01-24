<?php

    namespace core\components;

    class View{
        protected $_layout = 'app/views/layouts/main.php';
        protected $_css = [];

        /**
         * @param string $tpl
         * @param array $data
         *
         * @return string
         * @throws \Exception
         */
        public function render($tpl, $data){
            extract($data);
            $path = 'app/views/'.$tpl.'.php';
            if(!file_exists($path)){
                throw new \Exception('View file: ['.$tpl.'] not found!');
            }
            ob_start("ob_gzhandler");
            include $path;
            $content = ob_get_clean();
            ob_start("ob_gzhandler");
            include $this->_layout;
            return ob_get_clean();
        }

        public function addCssLink($css){
            $this->_css[] = $css;
        }

        public function renderCss(){
            foreach($this->_css as $css){
                echo '<link rel="stylesheet" href="assets/'.$css.'">';
            }
        }
    }