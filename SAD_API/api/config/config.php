<?php
// mute error
error_reporting(E_ALL & ~E_NOTICE);

// define database
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_CHAR", "utf8");
define("DB_CUSTOMER", "vlu-customer");
define("DB_ADMIN", "vlu-center");
define("DB_BRANCH", "vlu-branch");

// secret_key for password
define("SECRET_KEY", "6AD3A9478F1C41621CC342D325BC73ED825E0C69");

// define path
define('PATH_LIB', __DIR__ . DIRECTORY_SEPARATOR);
?>