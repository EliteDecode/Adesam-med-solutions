function calculateQuantityBefore(event) {
  var target = event.target;
  var td = target.parentNode;
  var tr = td.parentNode;
  var quantitybefore = tr.getElementsByTagName("input")[2].value;

  quantitybefore = quantitybefore * 5;
  changeValueBefore(quantitybefore, event);
}

function changeValueBefore(value, event) {
  var target = event.target;
  var td = target.parentNode;
  var tr = td.parentNode;
  tr.getElementsByTagName("input")[2].value = value;
  sumTotalBottles(event);
  calculateTotal(event);
  calculateProfit(event);
}

//Quantity After
function calculateQuantityAfter(event) {
  var target = event.target;
  var td = target.parentNode;
  var tr = td.parentNode;
  var quantityAfter = tr.getElementsByTagName("input")[3].value;

  quantityAfter = quantityAfter * 2.5;

  changeValueAfter(quantityAfter, event);
}

function changeValueAfter(value, event) {
  var target = event.target;
  var td = target.parentNode;
  var tr = td.parentNode;
  tr.getElementsByTagName("input")[3].value = value;

  sumTotalBottles(event);
  calculateTotal(event);
  calculateProfit(event);
}

//Bottles sold
function calculateBottlesSold(event) {
  var target = event.target;
  var td = target.parentNode;
  var tr = td.parentNode;

  var bottlesSold = tr.getElementsByTagName("input")[1].value;

  bottlesSold = bottlesSold * 3.1;

  changeBottlesSold(bottlesSold, event);
}

function changeBottlesSold(value, event) {
  var target = event.target;
  var td = target.parentNode;
  var tr = td.parentNode;
  tr.getElementsByTagName("input")[1].value = value;

  sumTotalBottles(event);
  calculateTotal(event);
  calculateProfit(event);
}

//Calculate total bottles

function sumTotalBottles(event) {
  var target = event.target;
  var td = target.parentNode;
  var tr = td.parentNode;

  var bottlesBefore = parseFloat(tr.getElementsByTagName("input")[1].value);
  var quantityBefore = parseFloat(tr.getElementsByTagName("input")[2].value);
  var quantitiesAfter = parseFloat(tr.getElementsByTagName("input")[3].value);
  tr.getElementsByTagName("input")[4].value =
    bottlesBefore + quantityBefore + quantitiesAfter;
}

function calculateTotal(event) {
  var target = event.target;
  var td = target.parentNode;
  var tr = td.parentNode;
  var pricePerCan = tr.getElementsByTagName("input")[0].value;
  var priceOfDrink = tr.getElementsByTagName("input")[5].value;
  var totalDrinks = tr.getElementsByTagName("input")[4].value;

  var grossSale = tr.getElementsByTagName("input")[6];
  var cogUsed = tr.getElementsByTagName("input")[7];
  grossSale.value = totalDrinks * priceOfDrink;
  cogUsed.value = totalDrinks * pricePerCan;
}

function calculateProfit(event) {
  var target = event.target;
  var td = target.parentNode;
  var tr = td.parentNode;

  var grossSale = parseFloat(tr.getElementsByTagName("input")[6].value);
  var cogUsed = parseFloat(tr.getElementsByTagName("input")[7].value);

  tr.getElementsByTagName("input")[8].value = (grossSale - cogUsed).toFixed(2);
}
