let addButton = document.getElementById('addButton');
let addForm = document.getElementById('addForm');
let addStud = document.getElementById('addStud');
let buttonModal = document.getElementById('buttonModal');
let modal = document.getElementById('modal_');
let count = 1;
const button = document.querySelectorAll('data-id');

//  button.addEventListener('click', (event) => { 
//     let id = event.target.getAttribute('data-id');
//      console.log(id);
    
//      modal.style.display = "block";  
//  });


function add() {

    addButton.style.display = "none";
    addForm.style.display = 'block';
    
}

function addStudent() {

    addButton.style.marginLeft = "42.3%";
    addButton.style.display = "block";
    addForm.style.display = 'none';

}

function openModal() {

console.log(button);
    modal.style.display = "block"
}

function closeModal() {
    modal.style.display = "none"
}

