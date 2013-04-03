/** 
 * Load ajax in the targer:
 * ex: href='origin' data-ajax-load-html='#target'
 */

$('body').delegate('[data-ajax-load-html]', 'click', function(e){
    e.preventDefault();
                
    $this = $(this);
    origin = $this.attr('href');
    destiny = $this.data('ajax-load-html');
    method = $this.data('method') ? $this.data('method') : 'GET';
    $destiny = $(destiny);

    $.ajax({
        url: origin,
        dataType: 'html',
        cache: false,
        type: method,
        beforeSend: function(){
            $destiny.html('Loading...');
        },
        success: function(data){
            $destiny.html(data);
        },
        error: function(){
            $destiny.html('Error page not found...');
        }
    });
});
