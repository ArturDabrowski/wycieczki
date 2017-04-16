<?php

class Validate {
    //wlasciwosc $error bedzie sluzyc do przechowywania komunikatu bledow
    private $error;
    public $liczError=0;
            
    function __construct() {
        $this->error='';
        $this->liczError=0;
    }
    function AddError($text){
        $this->error.=$text.'<br>';
    }
    function __destruct() {
        if(!empty($this->error)){
            echo '<div class="error" id="error">'.$this->error.'</div>';
        }
    }
    
    function puste($ciag,$pole){
        //trim wycina puste znaki z poczatku i konca ciagu, a empty sprawdza czy nie jest puste
        if(empty(trim($ciag))){
            $this->AddError("Pole $pole nie moze byc puste.");
            $this->liczError++;
        }
    }
    function znakiOK($ciag, $pole) {
        if(!preg_match('/[a-z_.]/i', $ciag)){
            $this->AddError("Pole $pole nie moze byc puste, zawierac cyfr i znakow specjalnych.");
            $this->liczError++;
        }
    }
    function minIloscZnakow($ciag,$pole,$min){
        if(strlen(trim($ciag))<$min){
            $this->AddError("Pole $pole musi miec minimum 6 znakow.");
            $this->liczError++;
        }
    }
    function validatePhone($ciag, $pole){
        if(!preg_match('/^[0-9].{0,11}$/', trim($ciag))) {
            $this->AddError("You can type max 12 digits.");
            $this->liczError++;
        }
    }
    function validatePostCode($ciag, $pole){
        if(!preg_match('/^[0-9]{2}-?[0-9]{3}$/Du', trim($ciag))) {
            $this->AddError("Kod pocztowy nie może być pusty, musi mieć następujący format: XX-XXX.");
            $this->liczError++;
        }
    }
            
    
    function znakiPL($ciag,$pole){
        if(preg_match('/[ęąółśćżźć]/i', $ciag)){
            $this->AddError("Pole $pole nie moze zawierac znakow PL.");
            $this->liczError++;
        }
    }
    function znakiSpecjalne($ciag, $pole){
        if(preg_match('/[?@#$%^&*()!{}":><\]\[]/', $ciag)){
            $this->AddError("Pole $pole nie moze zawierac znakow specjalnych: !@#$%^&*(){}[]:\"<>,./?\'+_-=");
            $this->liczError++;
        }
    }
    function haslo($ciag1,$pole1,$ciag2,$pole2){
        if ($ciag1!=$ciag2) {
            $this->AddError("Pole $pole1 musi byc takie samo jak pole $pole2");
            $this->liczError++;
        }
    }
    function validateEmail($ciag, $pole){
        if(!filter_var($ciag, FILTER_VALIDATE_EMAIL)){
            $this->AddError("Pole $pole jest puste bądź nie zawiera poprawnego adresu e-mail");
            $this->liczError++;

        }
    }
    function isChecked($pole){
        $this->AddError("Pole $pole musi byc zaznaczone.");
        $this->liczError++;
    }
    function validateInt($ciag, $pole){
        if (!filter_var($ciag, FILTER_VALIDATE_INT)){
            $this->AddError("Pole $pole nie zawiera liczby calkowitej");
            $this->liczError++;
        }
    }
    function validateFloat($ciag, $pole){
        $ciagp= str_replace(',', '.', $ciag);
        if (!filter_var($ciagp, FILTER_VALIDATE_FLOAT)){
            $this->AddError("Pole $pole nie zawiera liczby zmiennoprzecinkowej");
            $this->liczError++;
        }
    }
    function validatePass($ciag, $pole){
        if(!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*()_+|-]).{8,30}$/",$ciag)){
            $this->AddError("Haslo musi mieć min. 8, max. 30 znaków oraz musi<br> zawierać jedną małą literę, jedną dużą literę, cyfrę i znak specjalny.");
            $this->liczError++;
        }
    }
}

