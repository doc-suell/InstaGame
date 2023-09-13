'use strict';

const modal = document.getElementById('modal');
const modalButton = document.getElementById('modal-button');


console.log(modal);
console.log(modalButton);



modalButton.addEventListener('click', () =>{
    console.log("lol");
    modal.classList.toggle('hiden');

})