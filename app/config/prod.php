<?php

// Timezone
date_default_timezone_set('Europe/Kiev');

// Cache
$app['cache.path'] = __DIR__ . '/../cache';

// Twig cache
$app['twig.options.cache'] = $app['cache.path'] . '/twig';

// Emails
$app['admin_email'] = 'noreply@2hd.com.ua';
$app['site_email'] = 'noreply@2hd.com.ua';

// Doctrine (db)
$app['db.options'] = [
    'driver'   => 'pdo_mysql',
    'host'     => '88.198.72.174', // http://2hd.com.ua
    'port'     => '3306',
    'dbname'   => 'delivery_database',
    'user'     => 'root',
    'password' => 'gh6ECm8mPd59QP',
];

$app['debug'] = true;

/*
// SwiftMailer
// See http://silex.sensiolabs.org/doc/providers/swiftmailer.html
$app['swiftmailer.options'] = array(
    'host' => 'host',
    'port' => '25',
    'username' => 'username',
    'password' => 'password',
    'encryption' => null,
    'auth_mode' => null
);
*/
