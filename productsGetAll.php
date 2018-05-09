<?php

require_once './config.php';
require_once './classes/DbClass.php';
require_once './classes/DbClassExt.php';
$db = new DbClassExt('mysql:host=' . HOST . ';dbname=' . DB, USER, PASSWORD);

$db->setTable('tb_products P');
$db->setColumns('P.id AS pid,L.id AS lid,P.name,P.price,P.productnr, L.label');
$db->setJoin('tb_labels L', DbClassExt::INNER, 'L.id', 'P.labelid');
$db->setOrderBy('P.name');
$data = $db->getData(); 
echo json_encode($data);
