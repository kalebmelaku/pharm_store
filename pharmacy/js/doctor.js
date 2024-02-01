const btn_lab = document.getElementById('btn-lab');
const btn_detail = document.getElementById('btn-detail');
const lab = document.getElementById('lab');
const pat_detail = document.getElementById('patient-detail');

btn_lab.addEventListener('click', () => {
	lab.classList.toggle('hide');
	btn_lab.classList.toggle('now')
});
btn_detail.addEventListener('click', () => {
	pat_detail.classList.toggle('hide')
	btn_detail.classList.toggle('now')
});


//ultrasound
const abus = document.getElementById('abus-text');
const bus = document.getElementById('bus-text');
const neck = document.getElementById('neck-text');
const nb = document.getElementById('nb-text');
const other = document.getElementById('other-text');
const check = document.querySelectorAll('input[name="brands[]"]');


check.forEach(item => {
	item.addEventListener('change', () => { 
		if (item.value == "Abdominal") {
			abus.classList.toggle('hide');
		} else if (item.value == "Chest") {
			bus.classList.toggle('hide');
		} else if (item.value == "Neck") {
			neck.classList.toggle('hide');
		} else if (item.value == "normal_brain") {
			nb.classList.toggle('hide');
		}else if (item.value == "other") {
			other.classList.toggle('hide');
		}
	})
});