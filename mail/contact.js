 $('#contact').submit(function(e){
    e.preventDefault();
    $.ajax({
        url: './Ecom/message.php',
        type: 'post',
        data:$('#contact').serialize(),
        success:function(){
            // Whatever you want to do after the form is successfully submitted
        }
    });
});