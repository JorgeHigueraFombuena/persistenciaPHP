<?php   // config/config.php

/*
 * configuración SGBD
 */
define('DATABASE_DBNAME', 'miw16_results');
define('DATABASE_USER', 'user');
define('DATABASE_PASSWD', 'user');
define('DATABASE_DRIVER', 'pdo_mysql');
define('DATABASE_CHARSET', 'UTF8');

/*
 * configuración Doctrine
 */
define('PROXY_DIR', '/xampp/tmp');
define('ENTITY_DIR', __DIR__ . '/../Entity');
define('DEBUG', false);  // muestra consulta SQL por la salida estándar
