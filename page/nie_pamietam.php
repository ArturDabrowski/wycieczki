

<div class="container">
<form method="post">
    <div class="passy">
        <input name="mail" placeholder="Podaj adres e-mail."> <br>
    </div>
    <input type="submit" id="zapisz" value="Wyślij" name="przypomnij">
</form>
    <hr>   
<a href="index.php"><button>Powrót do logowania</button></a>
</div>
<div class="komunikat">
    <?php
  
  $modKonto=new Account();
  $modKonto->modAccount();
    
?>
</div>




