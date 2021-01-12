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

        public function fetchData() {

            $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
            if ($contentType === "application/json") {
                $content = trim(file_get_contents("php://input"));
                $decoded = json_decode($content, true);

                switch (strtolower($decoded['requestType'])) {
                    case 'trip':
                        $controller = new TripController();
                        $controller->fetchTrips($decoded['data']); break;
                    case 'membership':
                        $controller = new TripController();
                        $controller->participate($decoded['data']); break;
                    case 'poi': $controller = new TripController();
                        $controller->fetchPOI($decoded['data']); break;
                    case 'user': $controller = new UserController();
                        $controller->fetchUsers($decoded['data']); break;
                    case 'comment': $controller = new CommentController();
                        $controller->fetchComments($decoded['data']); break;
                    default: header('Content-type: application/json');
                        http_response_code(404);
                        echo 'Request not supported';
                }
                return;
            }

        }
    }