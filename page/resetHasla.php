
<div class="container">
            <form method="post"> 
            <div class="passy">
                <input name="haslo"  type="password" placeholder="Podaj haslo"> <br>
                <input name="haslo2" type="password" placeholder="Powtorz haslo"> <br>
            </div>
                <input name="zapisz" type="submit" id="zapisz" value="Zapisz"><br>
            </form>
    </div>
<div class="komunikat">
    
    <?php
    $reset=new Account();
    $reset->resetPassword();
    ?>
</div>



