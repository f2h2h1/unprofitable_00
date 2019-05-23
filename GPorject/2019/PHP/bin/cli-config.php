<?php
// cli-config.php
require_once "../app/bootstrap.php";
require_once "../vendor/autoload.php";

function getFileList2($directory) {
    $files = array();
    if(is_dir($directory)) {
        if($files = scandir($directory)) {
            $files = array_slice($files, 2);
        }
    }
    return $files;
}
$modelDir = '../app/Models/';
$modelFileList = getFileList2($modelDir);
foreach($modelFileList as $item) {
    $modelFile = $modelDir.$item;
    if (strpos($modelFile, '.php') !== false) {
        require_once $modelFile;
    }
}

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
