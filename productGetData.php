<?php

$pid = filter_input(INPUT_GET, 'pid', FILTER_VALIDATE_INT);
require_once './config.php';
require_once './classes/DbClass.php';
require_once './classes/DbClassExt.php';

$db = new DbClassExt('mysql:host=' . HOST . ';dbname=' . DB, USER, PASSWORD);
$db->setTable('tb_labels L');
$db->setColumns('L.id AS lid,P.id AS pid,L.label,P.name,P.price,P.productnr');
$db->setJoin('tb_products P', DbClassExt::INNER, 'L.id', 'P.labelid');
$db->setWhere('P.labelid='.$pid);
$data = $db->getData();
echo json_encode($data);
