<?php
/**
 * mysql
 */
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$host = $url["host"];
$username = $url["user"];
$password = array_key_exists('pass', $url) ? $url["pass"] : '';
$database = substr($url["path"], 1);

return array(
    'connections' => array(
        'mysql' => array(
            'driver'    => 'mysql',
            'host'      => $host,
            'database'  => $database,
            'username'  => $username,
            'password'  => $password,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),
    )
);
