/** 
 * Mount and put de query string in the form button
 * ex: data-form-identification='.search-row' get all input children of .search-row,
 * serialize and replace de href of form button
 */

$('body').delegate('[data-form-identification]', 'click', function(e){
    e.preventDefault();

    var $this = $(this);
    var form = $this.data('form-identification');
    var querystring = '?'+$this.parents(form).find(':input').serialize();
    
    $this.attr('href', $this.attr('href') + querystring);
});