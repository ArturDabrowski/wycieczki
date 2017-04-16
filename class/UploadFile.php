
        <?php
            class UploadFile extends DbConnect{
                protected $error;
                protected $type;
                protected $size;
                protected $name;
                protected $name_replace;
                protected $tmp_name;
                protected $wejscie;
                protected $wyjscie;
                protected $dir;
                protected $description;
                protected $dzis;
                
                public function __construct($fileName, $fileDescription='') {
                    $this->description = $fileDescription;
                    $this->dzis = date('Y-m-d');
                    
                    //kody bledow
                    $this->error=$_FILES[$fileName]['error'];
                    
                    if($this->error>0){
                        $this->checkNumberError();
                    }
                    
                    //typ pliku
                    $this->type=$_FILES[$fileName]['type'];
                    
                    //rozmiar pliku
                    $this->sieze=$_FILES[$fileName]['size'];
                    
                    $this->name=$_FILES[$fileName]['name'];
                    
                    //nazwa tymczasowa
                    $this->tmp_name=$_FILES[$fileName]['tmp_name'];
                    
                    $this->dir='dokumenty';
                    
                    //likwidacja niedozwolonych znakow
                    $this->wejscie=array('ż','ó','ł','ć','ę','ś','ą','ź','ń','Ż','Ó','Ł','Ć','Ę','Ś','Ą','Ź','Ń',' ','-','~','`','!','@','#','$','%','^','&','*','(',')','+','=','{','}','[',']',':',';','\'','"','|','\\','/','?',',','<','>');

                    $this->wyjscie=array('z','o','l','c','e','s','a','z','n','z','o','l','c','e','s','a','z','n','_','_','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
                    
                    $this->name_replace= strtolower(str_replace($this->wejscie, $this->wyjscie, $this->name));
                    
                    if(!empty($this->name_replace)){
                        $this->checkType();
                    }
                }//end constructor
                
                protected function checkNumberError(){
                    switch($this->error){
                        case 1:
                            $this->showError('Rozmiar pliku jest wiekszy niż przewiduje konf. pliku php.ini');
                            break;
                        case 2:
                            $this->showError('Rozmiar pliku jest wiekszy niż przewiduje ustawienie MAX_FILE_SIZE');
                            break;
                        case 3:
                            $this->showError('Plik nie zostal odebrany w calosci');
                            break;
                        case 4:
                            $this->showError('Plik nie zostal wybrany');
                            break;
                        default:
                            $this->showError('Wystąpil niezidentyfikowany blad. Skontaktuj sie z administratorem, pozdro.');
                            
                    }//end switch
                    return false;
                }//end checkNumberErrror
                
                public function showFileInfo(){
                    echo "Typ pliku: $this->type <br>";
                    echo "Rozmiar pliku: $this->size <br>";
                    echo "Poczatkoa nazwa pliku: $this->name <br>";
                    echo "Koncowa nazwa pliku: $this->name_replace <br>";
                    echo "Nazwa tymczasowa pliku: $this->tmp_name <br>";
                    echo "Kod bledu: $this->error <br>";
                }//end showFileInfo
                
            protected function showError($kom){
                echo '<span class="error">'.$kom.'</span><br>';
            }//end showError
            
            protected function checkType(){
                $dozwolone_rozszerzenia = array("jpeg","jpg","pdf","png","gif");
                
                $plik_rozszerzenie = pathinfo($this->name_replace,PATHINFO_EXTENSION);
                
                if(!in_array($plik_rozszerzenie, $dozwolone_rozszerzenia, true)){
                   $this->showError('Niedozwolone rozszerzeie pliku');
                } else {
                    $this->ifDirExists();
                }
            }//end checkType
            
            protected function ifDirExists(){
                if(!file_exists($this->dir)){
                    mkdir($this->dir,0777); //pelne uprawnienia linuksowe | (r)ead - 4, (w)rite-2, e(x)ecute - 1 = 7 sticky bit, owner, group, others                       
                }
                 $this->ifFileExists();
            }//end ifDirExists
            
            protected function ifFileExists(){
                if(!file_exists($this->dir.'/'.$this->name_replace)){
                    $this->saveFile();
                    $id_exc=$_GET['id'];
                    $urlZdjecie=$this->dir.'/'.$this->name_replace;
                    $zapytanie="update `exc` set `urlZdjecie`='$urlZdjecie' where `id_exc`='$id_exc'";
                    $baza=new DbConnect();
                    $wynik= $baza->db->query($zapytanie);
                }else{
                    $this->showError('Taki plik juz istnieje');
                }
            }//end ifFileExists
            
            protected function saveFile(){
                if(is_uploaded_file($this->tmp_name)){
                    if(move_uploaded_file($this->tmp_name, $this->dir.'/'.$this->name_replace)){
                        //tu wyslac zapytanie zeby to zapisal
                        echo 'Plik dodany na server';
                    }
                }
            }
        
            }//end class
            
            
            
        ?>
        
