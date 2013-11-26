#!/usr/bin/env php
<?php

require_once __DIR__.'/base_script.php';

//build_bootstrap();

show_run("database:drop", "php app/console doctrine:database:drop --force");
show_run("database:create", "php app/console doctrine:database:create");
show_run("schema:create", "php app/console doctrine:schema:create");

show_run("Destroying cache dir manually", "rm -rf app/cache/*");
show_run("Destroying cache dir manually", "rm -rf app/logs/*");

//show_run("Creating directories for app kernel", "mkdir app/cache/dev");

show_run("Warming up dev cache", "php app/console --env=dev cache:clear");
show_run("Warming up dev cache", "php app/console --env=jura cache:clear");
//show_run("Warming up test cache", "php app/console --env=test cache:clear");

show_run("Changing permissions", "chmod -R 777 app/cache app/logs");
show_run("fixtures:load", "php app/console doctrine:fixtures:load --no-interaction");

show_run("assets:install", "php app/console assets:install --symlink");
show_run("Changing permissions", "chmod -R 777 app/cache app/logs");

exit(0);