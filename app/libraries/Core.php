<?php

    class Core {
        protected $currentController = 'pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct() {
            $url = $this->getUrl();

            // Look in the first value for the controllers.
            if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')) {
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            }

            // As the auto loader only searches class definition under the 'libraries' folder, so the
            // following 'require_once' must be included, as the controllers are located in a different folder.
            require_once '../app/controllers/'.$this->currentController.'.php';
            $this->currentController = new $this->currentController;

            // Look in the second value for the actions.
            if(isset($url[1])) {
                if(method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            // Look in the third value for the params.
            $this->params = $url ? array_values($url) : [];

            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl() {
            if(isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);

                return $url;
            }
        }
    }