const book = document.getElementById('book');
const lateral = document.querySelector('.barra');
const span = document.querySelector('span');

book.addEventListener('click', ()=>{
    lateral.classList.toggle("mini-lateral");
    span.classList.toggle("oculto");
});