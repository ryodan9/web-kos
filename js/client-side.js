// Scrolling Navigation Bar
// const nav = document.querySelector("nav");
// const sectionOne = document.querySelector(".jumbotron");

// const sectionOneOptions = {
//     rootMargin: "-700px 0px 0px 0px"
// };

// const sectionOneObserver = new IntersectionObserver
// (function(
//     entries, 
//     sectionOneObserver
// ){
//     entries.forEach(entry => {
//         if(!entry.isIntersecting) {
//             nav.classList.add("nav-scrolled");
//         } else {
//             nav.classList.remove("nav-scrolled");
//         }
//     });
// }, 
// sectionOneOptions);

// sectionOneObserver.observe(sectionOne);

var nav = document.querySelector('nav'); // Identify target

window.addEventListener('scroll', function(event) { // To listen for event
    event.preventDefault();

    if (window.scrollY <= 150) { // 
        nav.style.backgroundColor = 'transparent'; // or default color
        nav.style.boxShadow = "0px 0px 0px black";
    } else {
        nav.style.backgroundColor = '#fff';
        nav.style.boxShadow = "1px 2px 15px black";
    }
});

