$(function(){
  
    $('#anulujS').click(function(event){
        event.preventDefault();
        $('#modalS').fadeOut(2000);
       $('#dodS').fadeOut(1000);
       

        
        
    });
    $(document).keyup(function(e){
        if(e.keyCode==27){
            $('#modalS').fadeOut(2000);
            $('#dodS').fadeOut(1000);
            

        }
    });
    
//    $('#error').css('transform', 'translateX(330px)');

});


