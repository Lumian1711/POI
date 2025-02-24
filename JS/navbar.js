const book = document.getElementById('book');
const lateral = document.querySelector('.barra');
const spans = document.querySelectorAll('span');
const main = document.querySelector('main');

book.addEventListener('click',()=>{
    lateral.classList.toggle("lateral");
    main.classList.toggle("grande");
    spans.forEach((span)=>{
        span.classList.toggle("oculto");
    });
});
