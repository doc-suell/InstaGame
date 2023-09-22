'use strict';

const modal = document.getElementById('modal');
const modalButton = document.getElementById('modal-button');



modalButton.addEventListener('click', () =>{
    modal.classList.toggle('hidden');
})


