<?php
    /*
     * Base controller.
     * Loads the models and views.
     * */
    class Controller {
        public function getModel($model) {
            require_once '../app/models/'.$model.'.php';
            return new $model;
        }

        public function requireView($view, $data = []) {
            if(file_exists('../app/views/'.$view.'.php')) {
                require_once '../app/views/'.$view.'.php';
            } else {
                die('View does not exist');
            }
        }
    }