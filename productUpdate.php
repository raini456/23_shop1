<?php

require_once './config.php';
require_once './classes/DbClass.php';
require_once './classes/DbClassExt.php';
require_once './classes/FilterForm.php';

$db = new DbClassExt('mysql:host=' . HOST . ';dbname=' . DB, USER, PASSWORD);

//Label
$lid = filter_input(0, 'lid', FILTER_VALIDATE_INT);

if (!is_int($lid)) {
 exit();
}

//Customer Daten filtern
$fL = new FilterForm();
$fL->setFilter('label', 513);
$lData = $fL->filter(INPUT_POST);
//Customer Daten in Tabelle aktualisieren 
$db->setTable('tb_labels');
$db->update($lData, $lid);

//Adresse

$pid = filter_input(0, 'pid', FILTER_VALIDATE_INT);

if (!is_int($pid)) {
 exit();
}

//Customer Daten filtern
$fP = new FilterForm();
$fP->setFilter('name', 513);
$fP->setFilter('price', 513);
$fP->setFilter('productnr', 513);
$pData = $fP->filter(INPUT_POST);
//Customer Daten in Tabelle aktualisieren 
$db->setTable('tb_products');
$db->update($pData, $pid);
echo 1;
