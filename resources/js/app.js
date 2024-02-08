var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

const resizeJsFullheight = function() {
    let elements = document.getElementsByClassName('js-fullheight');

    for (let i = 0; i < elements.length; i++) {
        elements[i].style.height = window.innerHeight + 'px';
    }
}

const fadeInHiddenElements = function() {
    let elements = document.getElementsByClassName('js-show-on-loaded');

    for (let i = 0; i < elements.length; i++) {
        elements[i].classList.remove('opacity-0');
        elements[i].classList.add('opacity-100');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('loader').remove();

    document.getElementById('back-to-top').addEventListener('click', function (event) {
        event.preventDefault();

        window.scroll({top: 0, left: 0, behavior: 'smooth'});
    });

    if ( !isMobile.any() ) {
        window.addEventListener('resize', () => {
            resizeJsFullheight();
        });

        resizeJsFullheight();
        fadeInHiddenElements();
    }
})
