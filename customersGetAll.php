<?php

require_once './config.php';
require_once './classes/DbClass.php';
require_once './classes/DbClassExt.php';

require_once './classes/Customer.php';
require_once './classes/Address.php';

$db = new DbClassExt('mysql:host=' . HOST . ';dbname=' . DB, USER, PASSWORD);

$db->setTable('tb_customers C');
$db->setColumns('C.id AS cid,A.id AS aid,C.firstname,C.lastname,A.street,A.zip,A.city');
$db->setJoin('tb_addresses A', DbClassExt::INNER, 'C.id', 'A.cid');
$db->setOrderBy('C.lastname');
$data = $db->getData();
echo json_encode($data);
