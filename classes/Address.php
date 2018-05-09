<?php

class Address {

 private $street;
 private $zip;
 private $city;

 public function __construct(string $street, string $zip, string $city) {
  $this->street($street);
  $this->zip($zip);
  $this->city($city);
 }

 public function street($param = NULL) {
  if ($param === NULL) {
   return $this->street;
  }
  $street = filter_var($param, FILTER_SANITIZE_STRING);
  if (is_string($street)) {
   $this->street = $street;
  }
 }

 public function zip($param = NULL) {
  if ($param === NULL) {
   return $this->zip;
  }
  $zip = filter_var($param, FILTER_SANITIZE_NUMBER_INT);
  if (is_numeric($zip)) {
   $this->zip = $zip;
  }
 }

 public function city($param = NULL) {
  if ($param === NULL) {
   return $this->city;
  }
  $city = filter_var($param, FILTER_SANITIZE_STRING);
  if (is_string($city)) {
   $this->city = $city;
  }
 }

 public function addressLine() {
  return $this->street() . ';' . $this->zip() . ';' . $this->city();
 }

}
