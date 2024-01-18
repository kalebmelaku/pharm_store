const alert = document.getElementById('alert-box');
const error_text = document.getElementById('error-text');
const statusCode = document.getElementById('status');
if (error_text.innerText == '') {
    alert.classList.add('hidden')
} 
else {
    alert.classList.remove('hidden')
    setTimeout(()=>{
        alert.classList.add('hidden')
    }, 5000)
}
if(error_text.innerText == 'Logged out Successfully') {
    alert.classList.remove('bg-danger')
    alert.classList.remove('dark:bg-danger')
    alert.classList.add('bg-success')
}
if(statusCode.value == 200) {
    alert.classList.remove('bg-danger')
    alert.classList.remove('dark:bg-danger')
    alert.classList.add('bg-success')
} else if (statusCode.value == 401) {
    alert.classList.add('bg-danger')
    alert.classList.add('dark:bg-danger')
    // alert.classList.add('bg-success')
}