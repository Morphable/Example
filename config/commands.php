<?php

use \App\Command\Migrate;
use \App\Infrastructure\Application as A;

return [
    new Migrate(A::getService('database'), A::getPath('data') . '/app.db', A::getPath('config') . '/migrations.sql')
];
