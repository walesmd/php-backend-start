<?php
require 'vendor/autoload.php';
require 'hawkeye/common/DBTable.php';

$app = new \Slim\Slim();

$app->group('/v1', function() use ($app) {
    $app->get('/:table', function ($table) use ($app) {
        $format = $app->request->params('format');
        if (!$format) $format = 'json';

        $dbConfig = require 'config/db.php';
        $dbTable = new \Hawkeye\common\DBTable($dbConfig, $table, $format);

        $app->response->headers->set('Content-Type', $dbTable->getContentType());
        $dbTable->getData();
    });
});

$app->run();
