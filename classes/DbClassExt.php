<?php

class DbClassExt extends DbClass {

 private $columns = '*';
 private $statement = '';
 private $orderby = '';
 private $where = '';
 private $groupby = '';
 private $join = [];
 
 const INNER  = 'INNER';
 const LEFT  = 'LEFT';
 const RIGHT  = 'RIGHT';

 /**
  * ->setTable('tb_customers C');
  * ->setJoin('tb_addresses A','LEFT','C.id','A.cid')
  * @param type $type
  * @param type $tn
  * @param type $on
  */
 public function setJoin(string $tn, string $type, string $col1, string $col2) {
  $this->join[] = sprintf("%s JOIN %s ON %s=%s", $type, $tn, $col1, $col2);
 }

 public function setGroupBy(string $param) {
  $this->groupby = $param;
 }

 public function setWhere(string $param) {
  $this->where = $param;
 }

 /**
  * Sort by columns
  * examples
  * 
  * 
  * 
  * @param string $o examples id ASC,name DESC
  */
 public function setOrderBy(string $o) {
  $this->orderby = $o;
 }

 public function setStatement(string $st) {
  $this->statement = $st;
 }

 /**
  * C.lastname,A.street,C.id AS CID
  * lastname,firstname

  * @param string $cols
  */
 public function setColumns(string $cols) {
  $this->columns = $cols;
 }

 public function getColumns() {
  return $this->columns;
 }

 public function getData() {

  $j = (count($this->join) > 0) ? implode(' ', $this->join) : '';
  $w = ($this->where !== '') ? ' WHERE ' . $this->where : '';
  $o = ($this->orderby !== '') ? ' ORDER BY ' . $this->orderby : '';
  $g = ($this->groupby !== '') ? ' GROUP BY ' . $this->groupby : '';

  $query = sprintf("SELECT %s %s FROM %s %s %s %s %s", 
          $this->statement, 
          $this->columns, 
          $this->tableName, 
          $j,
          $w, 
          $g, 
          $o);
  
//  echo $query;
  $stmt = $this->query($query);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);  
 }

 public function insertArray(array $data = []) {
  $keys = array_keys($data);
  $amountValues = count($data[$keys[0]]);
  for ($i = 0; $i < $amountValues; $i++) {
   $tmp = [];
   for ($j = 0; $j < count($keys); $j++) {
    $tmp[$keys[$j]] = $data[$keys[$j]][$i];
   }
   $this->insert($tmp);
  }
 }

}
