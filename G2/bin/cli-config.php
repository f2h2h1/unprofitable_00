<?php
// cli-config.php
require_once "../app/bootstrap.php";
require_once "../vendor/autoload.php";
return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
