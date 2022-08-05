$(document).ready(function(){
    $("input[name='CatalogSearch[engine_type]']").change(function() {
        console.log( this.value );
        $('.form-control').submit(function(){ before_submit('argument'); });

    });
    function before_submit() {
        return false;
    }
});