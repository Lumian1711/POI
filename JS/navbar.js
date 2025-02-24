const book = document.getElementById('book');
const lateral = document.querySelector('.barra');
const spans = document.querySelectorAll('span');
const main = document.querySelectorAll('main');

book.addEventListener('click', ()=>{
    lateral.classList.toggle("lateral");
    spans.forEach((span)=>{
        span.classList.toggle("oculto");
    });
    main.classList.toggle("min-main");

});