<?php
/**
 * Created by PhpStorm.
 * User: xfn
 * Date: 5/12/2018
 * Time: 9:46 PM
 */
    class Post {
        private $db;

        public function __construct() {
            $this->db = new Database;   // Auto loader will find it.
        }

        public function getPosts() {
            $this->db->query("SELECT * FROM posts");

            return $this->db->getResultSet();
        }
    }