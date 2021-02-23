const navSlide = () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');

    const navLinks = document.querySelectorAll('.nav-links li');

    burger.addEventListener('click', () => {
        console.log(nav.classList);
        nav.classList.toggle('nav-active');

        // animate links
        navLinks.forEach((link, index) => {
            // console.log(link);
            if (link.style.animation) {
                link.style.animation = "";
            } else {
                link.style.animation = `navLinkFade 0.5s ease forwards ${index / 10 + .5}s`;
            }
        });

        burger.classList.toggle("toggle");
    });
}
navSlide();