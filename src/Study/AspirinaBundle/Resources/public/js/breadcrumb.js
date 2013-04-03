/** 
 * Refresh breadcump
 * ex: data-breadcrumb="Produtos#Página#1"
 */

$('body').delegate('[data-breadcrumb]', 'click', function(e){
    breadcrumb($(this).data('breadcrumb'));
});

var breadcrumb = function(path){
    $breadcrumb = $('.breadcrumb');
    $breadcrumb.empty();
    
    itens = path.split('#');
    itemActive = itens.pop();
    
    $.each(itens, function(index, value){
        $('<li><a href="#">'+value+'</a><span class="divider">/</span></li>').appendTo($breadcrumb);
    });
    $('<li class="active">'+itemActive+'</li>').appendTo($breadcrumb);
};
