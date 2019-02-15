<?php

use \App\Command\Migrate;
use \App\Command\Query;
use \App\Infrastructure\Application as A;

return [
    new Query(A::getService('database')),
    new Migrate(A::getService('database'), A::getPath('data') . '/app.db', A::getPath('config') . '/migrations.sql')
];
