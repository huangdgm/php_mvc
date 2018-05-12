<?php
    class Pages extends Controller {
        private $postModel;

        public function __construct() {
            $this->postModel = $this->getModel('Post');
        }

        public function index() {
            $posts = $this->postModel->getPosts();
            $data = [
                'title' => 'Index page',
                'posts' => $posts
            ];

            $this->requireView('pages/index', $data);
        }

        public function about() {
            $data = ['title1' => 'About page'];
            $this->requireView('pages/about', $data);
        }
    }