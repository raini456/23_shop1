(function () {
 var selectProducts; 
 var formUpdateP;
 function init() {
  formUpdateP= document.querySelector('#formUpdateP');
  formUpdateP.addEventListener('submit', productUpdate);
  selectProducts = document.querySelector('[name="selectProducts"]');
  productsGetAll();
  selectProducts.addEventListener('change', getProductData);
 }

 
 function productsGetAll() {
  ajax('get', 'productsGetAll.php', {}, fillSelectProducts);
 }

 
 function productUpdate(e) {
  e.preventDefault();
  var fields = formUpdateP.querySelectorAll('input[name]');
  var params = {};
  for (var i = 0; i < fields.length; i++) {
   //console.log(fields[i].name,fields[i].value);
   params[fields[i].name] = fields[i].value;
  }
  ajax('post', 'productUpdate.php', params, resetProductFields);
 }

 function resetProductFields(r) {
  if (r === '1') {
   formUpdateP.reset();
   productsGetAll();
  }
 }

 function getProductData() {
  if (this.value === '')
   return false;
  ajax('get', 'productGetData.php', {pid: this.value}, fillProductFields);
 }

 function fillProductFields(json) {
  var data = JSON.parse(json);
  console.log(data);
  var product = data[0];
  console.log(product);
  for (var key in product) {
   document.querySelector('[name="' + key + '"]').value = product[key];
  }
 }
 function fillSelectProducts(json) {
  var data = JSON.parse(json);
  selectProducts.options.length = null;//Löschen aller aktuellen options

  var opt = document.createElement('option');//Erste option 
  opt.text = 'Bitte Produkt auswählen';
  opt.value = '';
  selectProducts.appendChild(opt);
  for (var i = 0; i < data.length; i++) {
   var d = data[i];
   var opt = document.createElement('option');
   opt.text = d.name + ', ' + d.productnr + ' ' + d.price + ' ' + d.label + ' ';
   opt.value = d.pid;
   opt.setAttribute('data-pid', d.pid);
   opt.setAttribute('data-lid', d.lid);
   selectProducts.appendChild(opt);
  }
 }




 window.addEventListener('load', init);

})();