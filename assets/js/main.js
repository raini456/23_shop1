(function () {

 var selectCustomers;
 var selectProducts;
 var formUpdate;
 var formUpdateP;
 function init() {
  formUpdate = document.querySelector('#formUpdate');
  formUpdateP= document.querySelector('#formUpdateP');
  formUpdate.addEventListener('submit', customerUpdate);
  formUpdateP.addEventListener('submit', productUpdate);
  selectCustomers = document.querySelector('[name="selectCustomers"]');
  selectProducts = document.querySelector('[name="selectProducts"]');
  customersGetAll();
  productsGetAll();
  selectCustomers.addEventListener('change', getCustomerData);
  selectProducts.addEventListener('change', getProductData);
 }

 function customersGetAll() {
  ajax('get', 'customersGetAll.php', {}, fillSelectCustomers);
 }
 function productsGetAll() {
  ajax('get', 'productsGetAll.php', {}, fillSelectProducts);
 }

 function customerUpdate(e) {
  e.preventDefault();
  var fields = formUpdate.querySelectorAll('input[name]');
  var params = {};
  for (var i = 0; i < fields.length; i++) {
   //console.log(fields[i].name,fields[i].value);
   params[fields[i].name] = fields[i].value;
  }
  ajax('post', 'customerUpdate.php', params, resetCustomerFields);
 }
 
 function productUpdate(e) {
  e.preventDefault();
  var fields = formUpdateP.querySelectorAll('input[name]');
  var params = {};
  for (var i = 0; i < fields.length; i++) {
   //console.log(fields[i].name,fields[i].value);
   params[fields[i].name] = fields[i].value;
  }
  console.log(params);
  ajax('post', 'productUpdate.php', params, resetProductFields);
 }

 function resetCustomerFields(r) {
  if (r === '1') {
   formUpdate.reset();
   customersGetAll();
  }
 }
 function resetProductFields(r) {
  if (r === '1') {
   formUpdateP.reset();
   productsGetAll();
  }
 }

 function getCustomerData() {
  if (this.value === '')
   return false;
  ajax('get', 'customerGetData.php', {aid: this.value}, fillCustomerFields);
 }
 
 function getProductData() {
  if (this.value === '')
   return false;
  ajax('get', 'productGetData.php', {pid: this.value}, fillProductFields);
 }

 function fillCustomerFields(json) {
  var data = JSON.parse(json);
  var customer = data[0];
  for (var key in customer) {
   document.querySelector('[name="' + key + '"]').value = customer[key];
  }
 }
 function fillProductFields(json) {
  var data = JSON.parse(json);
  var product = data[0];
  for (var key in product) {
   document.querySelector('[name="' + key + '"]').value = product[key];
  }
 }



 function fillSelectCustomers(json) {
  var data = JSON.parse(json);

  selectCustomers.options.length = null;//Löschen aller aktuellen options

  var opt = document.createElement('option');//Erste option 
  opt.text = 'Bitte Kunden auswählen';
  opt.value = '';
  selectCustomers.appendChild(opt);

  for (var i = 0; i < data.length; i++) {
   var d = data[i];
   var opt = document.createElement('option');
   opt.text = d.lastname + ',' + d.firstname + ' - ' + d.street + ' ' + d.zip + ' ' + d.city;
   opt.value = d.aid;
   opt.setAttribute('data-cid', d.cid);
   opt.setAttribute('data-aid', d.aid);
   selectCustomers.appendChild(opt);
  }

 }
 function fillSelectProducts(json) {
  var data = JSON.parse(json);

  selectProducts.options.length = null;//Löschen aller aktuellen options

  var opt = document.createElement('option');//Erste option 
  opt.text = 'Bitte Produkt auswählen';
  opt.value = '';
  selectCustomers.appendChild(opt);

  for (var i = 0; i < data.length; i++) {
   var d = data[i];
   var opt = document.createElement('option');
   opt.text = d.name + ',' + d.productnr + '  <b>' + d.price + '</b> <i>' + d.label + '</i> ';
   opt.value = d.pid;
   opt.setAttribute('data-pid', d.pid);
   opt.setAttribute('data-lid', d.lid);
   selectCustomers.appendChild(opt);
  }

 }




 window.addEventListener('load', init);

})();