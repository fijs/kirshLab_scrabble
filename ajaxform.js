jQuery(document).ready(function(){

    jQuery('.ajaxform').submit( function() {

        $.ajax({
            url     : $(this).attr('action'),
            type    : $(this).attr('method'),
            data    : $(this).serialize(),
            success : function( data ) {
                         alert('Your code has been emailed.');
                      },
            error   : function(){
                         alert('Something went wrong, please copy and paste your code into Mechanical Turk.');
                      }
        });

        return false;
    });

});