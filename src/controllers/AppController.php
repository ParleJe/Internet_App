<?php

    class AppController {
        private $request;

        public function __construct() {
            $this->request = $_SERVER['REQUEST_METHOD'];
        }

        protected function isPost(): bool {
            return $this->request === 'POST';
        }

        protected function render( string $template = null, array $vars=[] ) {
            $output = 'Error 69';
            $templatePath = 'public/views/'.$template.'.php';

            if(file_exists( $templatePath )){
                extract( $vars );

                ob_start();
                include $templatePath;
                $output = ob_get_clean();
            }
            print $output;
        }

        protected function getCurrentLoggedID(): ?int {
            session_start();
            if( isset( $_SESSION['user_id'] ) ) {
                return $_SESSION['user_id'];
            }
            return null;
        }

    }