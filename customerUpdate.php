<?php

require_once './config.php';
require_once './classes/DbClass.php';
require_once './classes/DbClassExt.php';
require_once './classes/FilterForm.php';

$db = new DbClassExt('mysql:host=' . HOST . ';dbname=' . DB, USER, PASSWORD);

//Customer
$cid = filter_input(0, 'cid', FILTER_VALIDATE_INT);

if (!is_int($cid)) {
 exit();
}

//Customer Daten filtern
$fC = new FilterForm();
$fC->setFilter('firstname', 513);
$fC->setFilter('lastname', 513);
$cData = $fC->filter(INPUT_POST);
//Customer Daten in Tabelle aktualisieren 
$db->setTable('tb_customers');
$db->update($cData, $cid);

//Adresse

$aid = filter_input(0, 'aid', FILTER_VALIDATE_INT);

if (!is_int($aid)) {
 exit();
}

//Customer Daten filtern
$fA = new FilterForm();
$fA->setFilter('street', 513);
$fA->setFilter('zip', 513);
$fA->setFilter('city', 513);
$aData = $fA->filter(INPUT_POST);
//Customer Daten in Tabelle aktualisieren 
$db->setTable('tb_addresses');
$db->update($aData, $aid);

echo 1;
