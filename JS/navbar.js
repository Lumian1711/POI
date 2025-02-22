const book = document.getElementById('book');
const lateral = document.querySelector('.barra');
const spans = document.querySelectorAll('span');

book.addEventListener('click', ()=>{
    lateral.classList.toggle("mini-lateral");
    
    spans.forEach((span)=>{
        span.classList.toggle("oculto");
    });
});