'use strict';

// document.addEventListener("DOMContentLoaded", (event) => {

//     //profil button modal
//     const modal = document.getElementById('modal');
//     const modalButton = document.getElementById('modal-button');

//     modalButton.addEventListener('click', () => {
//         modal.classList.toggle('hidden');
//     });
//     modalButton.addEventListener('click', () => {
//         setTimeout(() => {
//             modal.classList.toggle('hidden');
//         }, 2500);
//     });

// });


'use strict';

const modal = document.getElementById('modal');
const modalButton = document.getElementById('modal-button');



modalButton.addEventListener('click', () =>{
    modal.classList.toggle('hidden');
})



