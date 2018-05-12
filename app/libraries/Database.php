<?php
    class Database {
        private $db_host = DB_HOST;
        private $db_name = DB_NAME;
        private $db_user = DB_USER;
        private $db_pass = DB_PASS;

        private $dbh;
        private $stmt;
        private $error;

        public function __construct() {
            $dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            try {
                $this->dbh = new PDO($dsn, $this->db_user, $this->db_pass, $options);
            } catch(PDOException $exception) {
                $this->error = $exception->getMessage();
                echo $this->error;
            }
        }

        public function query($sql) {
            $this->stmt = $this->dbh->prepare($sql);
        }

        public function bind($param, $value, $type = null) {
            if(is_null($type)) {
                if(is_int($value)) {
                    $type = PDO::PARAM_INT;
                } else if(is_bool($value)) {
                    $type = PDO::PARAM_BOOL;
                } else if(is_null($value)) {
                    $type = PDO::PARAM_NULL;
                } else {
                    $type = PDO::PARAM_STR;
                }
            }

            $this->stmt->bindvalue($param, $value, $type);
        }

        public function execute() {
            return $this->stmt->execute();
        }

        // Get records as array of objects
        public function getResultSet() {
            $this->execute();

            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // Get single record as object
        public function getSingle() {
            $this->execute();

            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        public function getRowCount() {
            return $this->stmt-rowCount();
        }
    }