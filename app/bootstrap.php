<?php
    // Load config
    require_once 'config/Config.php';

    // Autoload core libraries
    spl_autoload_register(function($className) {
        require_once 'libraries/' . $className . '.php';
    });