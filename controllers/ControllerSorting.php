<?php
declare (strict_types = 1);
namespace controllers;

set_include_path(get_include_path() . PATH_SEPARATOR . realpath('..'));

session_start();
require_once '../controllers/ClassAutoLoader.php';
$classAutoLoader = new \controllers\ClassAutoLoader();
$classAutoLoader->autoLoader();

$sortingModel = new \models\ModelSorting();
$sortingData = $sortingModel->getSorting();
if ($sortingData != '') {
    $sorting = new \controllers\Sorting($sortingData['sorting'], $sortingData['sortingName'], $sortingData['whereClause'], $sortingData['modelProduct']);
    echo $sorting->productData();
}
