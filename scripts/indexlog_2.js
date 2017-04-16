$(function(){
    $('#dodaj').click(function(event){
        //blokuje domyslna akcje, w tym przypadku odswiezanie strony po kliknieciu w klawisz(link)
       event.preventDefault();
       $('#modal').css('display','block').hide().fadeIn(1000);
       $('#dod').css('display','block').hide().fadeIn(2000);
    });
    
    
    $('#anuluj').click(function(event){
        event.preventDefault();
        $('#modal').fadeOut(2000);
       $('#dod').fadeOut(1000);
//       $(location).attr('href', 'indexlog.php');
        var ciag = window.location.search;
        
        if (ciag.lastIndexOf("action=mod")!== -1){
          
            setTimeout("location.replace('indexlog_2.php')",2500)
        }
    });
    $(document).keyup(function(e){
        if(e.keyCode==27){
            $('#modal').fadeOut(2000);
            $('#dod').fadeOut(1000);
//            $(location).attr('href', 'indexlog.php');
            var ciag = window.location.search;
            if (ciag.lastIndexOf("action=mod")!== -1){
            location.replace('indexlog_2.php');
        }
        }
    });
    
    
});


