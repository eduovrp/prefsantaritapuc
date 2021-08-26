var pagina = window.location.pathname.split('/')[ window.location.pathname.split('/').length - 1 ];



if(pagina){
    $('.navbar-nav').find('a[href="'+pagina+'"]').closest('li').addClass('active');
} else {
    $('.navbar-nav').find('a[href="./"]').closest('li').addClass('active');
}
