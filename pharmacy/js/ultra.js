const btns = document.querySelectorAll('.items');

//lab
const abdo = document.getElementById('Abdominal');
const breast = document.getElementById('Chest');
const neck = document.getElementById('Neck');
const nb = document.getElementById('normal_brain');
const other = document.getElementById('other');

// btns.forEach(item => {
//     item.addEventListener('click', (e) => {
//         if (e.target.classList.contains ('Abdominal')) {
//             abdo.classList.toggle('hide');
//         } else if (e.target.classList.contains ('Chest')) {
//             breast.classList.toggle('hide');
//         } else if (e.target.classList.contains ('Neck')) {
//             neck.classList.toggle('hide');
//         }  else if (e.target.classList.contains ('normal_brain')) {
//             nb.classList.toggle('hide');
//         }  else if (e.target.classList.contains ('other')) {
//             other.classList.toggle('hide');
//         } 
//     })
// });

//ultra result
const liver = document.getElementById('liver_res');
const btn_liver = document.getElementById('remove');
const gb = document.getElementById('gb');
const btn_gb = document.getElementById('remove_gb');
const bowel = document.getElementById('bowel');
const btn_bowel = document.getElementById('remove_bowel');
const kid = document.getElementById('kid');
const btn_kid = document.getElementById('remove_kid');
const pel = document.getElementById('pel');
const btn_pel = document.getElementById('remove_pel');

btn_liver.addEventListener('click', (e) => {
    liver.value = "";

    e.preventDefault();
})
btn_gb.addEventListener('click', (e) => {
    gb.value = "";

    e.preventDefault();
})
btn_bowel.addEventListener('click', (e) => {
    bowel.value = "";

    e.preventDefault();
})
btn_kid.addEventListener('click', (e) => {
    kid.value = "";

    e.preventDefault();
})
btn_pel.addEventListener('click', (e) => {
    pel.value = "";

    e.preventDefault();
})