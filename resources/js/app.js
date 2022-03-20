require('./bootstrap');


// function logout(event) {
//     event.preventDefault();
//     document.getElementById('logout-form').submit();
// }
import ScrollReveal from 'scrollreveal';

ScrollReveal().reveal(".post",{
    origin : 'top',
    distance: '30px',
    duration : 500,
    interval : 700
});

new VenoBox({
    selector: '.venobox',
    numeration : true,
    infinigall : true,
    share : true,
    spinner : 'rotating-plane'
});
