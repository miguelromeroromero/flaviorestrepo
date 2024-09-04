$('.btn-ver-menu').on('click', function(){
    
    $('.pagina-izquierda').addClass("pagina-izquierda2");
    
    setTimeout(function(){
        
        $('.pagina-derecha').addClass("pagina-derecha2");
 
    }, 10)
    
})


$('.btn-cerrar').on('click', function(){
    
    $('.pagina-derecha').removeClass("pagina-derecha2");
    
    setTimeout(function(){
        
    $('.pagina-izquierda').removeClass("pagina-izquierda2");
 
    }, 10)
    
})