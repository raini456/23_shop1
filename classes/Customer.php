<?php

class Customer {

 private $firstname;
 private $lastname;
 private $address;
 private static $amount;
 private $db;

 public function __construct(string $firstname, string $lastname, Address $address) {
  $this->firstname($firstname);
  $this->lastname($lastname);
  $this->address($address);
//  $this->addCustomer();
//  self::$amount++;
 }

 public static function find(DbClassExt $db, $param) {
  $db->setTable('tb_customers');
  $param = trim($param);
  $db->setWhere("lastname='$param' OR firstname='$param'");
  return $db->getData();
 }

 public function insert(DbClassExt $db) {
  $this->db = $db;
  $cid = $this->addCustomer(); //$cid = lastid
  $this->addAddress($cid);
 }

 private function addCustomer() {
  $this->db->setTable('tb_customers');
  $data = [];
  //$data[columnName] = value
  $data['firstname'] = $this->firstname();
  $data['lastname'] = $this->lastname();
  return $this->db->insert($data); //return lastID
 }

 private function addAddress(int $cid) {
  $this->db->setTable('tb_addresses');
  $data = [];
  $data['cid'] = $cid;
  $data['street'] = $this->address->street();
  $data['zip'] = $this->address->zip();
  $data['city'] = $this->address->city();
  return $this->db->insert($data); //return lastID
 }

 public static function getAmount() {
  return self::$amount;
 }

 public function lastname($param = NULL) {
  if ($param === NULL) {
   return $this->lastname;
  }
  $name = filter_var($param, FILTER_SANITIZE_STRING);
  if (is_string($name)) {
   $this->lastname = $name;
  }
 }

 public function firstname($param = NULL) {
  if ($param === NULL) {
   return $this->firstname;
  }
  $name = filter_var($param, FILTER_SANITIZE_STRING);
  if (is_string($name)) {
   $this->firstname = $name;
  }
 }

 public function address($o = NULL) {
  if ($o === NULL) {
   return $this->address;
  }
  if (is_object($o)) {
   $this->address = clone($o);
  }
 }

 public function formatedAddress() {
  return sprintf("%s %s\n%s\n%s %s", $this->firstname(), $this->lastname(), $this->address->street(), $this->address->zip(), $this->address->city()
  );
 }

}
