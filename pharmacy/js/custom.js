//"use strict";
$(document).ready(function () {
	/*-- sidebar js --*/
	$("#sidebarCollapse").on("click", function () {
		$("#sidebar").toggleClass("active");
	});
	/*-- tooltip js --*/
	$('[data-toggle="tooltip"]').tooltip();
});
var ps = new PerfectScrollbar("#sidebar");

const sell = document.getElementById("sell");
// const btn = document.getElementById("plus");

// btn.addEventListener('click', () => {
// 	const para = document.createElement('div')
// 	para.innerHTML = `<select name="medicine" id="medicine">
// 	<option value="medicine">Name 1</option>
// 	<option value="medicine">Name 2</option>
// 	<option value="medicine">Name 3</option>
// </select>
// <input type="number" name="quantity" id="quantity" min="0" required>`

// 	para.insertBefore(btn, sell)
// });

let i = 1;
// btn.addEventListener("click", () => {
// 	i++;
// 	let element = document.createElement('div');
// 	element.classList.add('element');
// 	element.innerHTML = `<select name='medicine' id='medicine'> <option>Hello${i}</option> </select> <input type='number' name='quantity'>`
// 	//sell.insertBefore(btn);
// 	sell.append(element);
// });

// $(function () {
//     var duplicates = 0,
//         $original = $('.element').clone(true);

//     function DuplicateForm () {
//         var newForm;

//         duplicates++;

//         newForm = $original.clone(true).insertBefore($('.fa-3x'));

//         $.each($('input', newForm), function(i, item) {
// 		    $(item).attr('name', $(item).attr('name') + duplicates);
//         });

//     }

//     $('#plus').on('click', function (e) {
//         e.preventDefault();
//         DuplicateForm();
//     });
// });
const btn = document.getElementById('det_btn');
const detail = document.getElementById('det')

const btn_ultra = document.getElementById('det_ultra_btn');
const detail_ultra = document.getElementById('det_ultra')

btn_ultra.addEventListener('click', function (e) { 
	detail_ultra.classList.toggle('hide');
})
btn.addEventListener('click', function (e) { 
	detail.classList.toggle('hide');
})