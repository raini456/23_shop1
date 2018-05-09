<?php

$aid = filter_input(INPUT_GET, 'aid', FILTER_VALIDATE_INT);

require_once './config.php';
require_once './classes/DbClass.php';
require_once './classes/DbClassExt.php';

$db = new DbClassExt('mysql:host=' . HOST . ';dbname=' . DB, USER, PASSWORD);
$db->setTable('tb_addresses A');
$db->setColumns('C.id AS cid,A.id AS aid,C.firstname,C.lastname,A.street,A.zip,A.city');
$db->setJoin('tb_customers C', DbClassExt::INNER, 'C.id', 'A.cid');
$db->setWhere('A.id='.$aid);
$data = $db->getData();
echo json_encode($data);
