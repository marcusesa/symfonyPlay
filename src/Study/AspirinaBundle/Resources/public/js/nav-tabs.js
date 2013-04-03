$('body').delegate('.nav-tabs li', 'click', function(e){
    var $this = $(this);
    $this.siblings().removeClass('active');
    $this.addClass('active');
});