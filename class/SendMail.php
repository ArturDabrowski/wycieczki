<?php

class SendMail extends DbConnect{
            private $from, $Cc, $Bcc, $headers, $html, $to, $subject, $message, $htmlCodeStart, $htmlCodeEnd;
            
            function __construct($from,$Bcc='', $Cc='', $html='yes') {
                $this->from=$from;
                $this->Cc=$Cc;
                $this->Bcc=$Bcc;
                $this->headers='';
                $this->htmlCodeStart='';
                $this->htmlCodeEnd='';
                
                if($html=='yes'){
                    $this->htmlCodeStart='
                     <!DOCTYPE html>
                        <html>
                        <head>
                            <title>Untitled Document</title>
                            <meta charset="UTF-8">
                            <meta name="description" content="">
                            <meta name="keywords" content="">
                        </head>
                        <body>
                            ';
                    $this->htmlCodeEnd='
                            
                        </body>
                        </html>
                            ';
                    $this->headers="MIME-Version: 1.0\r\n";
                    $this->headers.="Content-type: text/html; charset=UTF-8\r\n";
                }
                $this->headers.="From:$this->from\r\n";
                
                if($this->Cc !=''){
                    $this->headers.="Cc:$this->Cc\r\n";
                }
                        
                if($this->Bcc !=''){
                    $this->headers.="Bcc:$this->Bcc\r\n";
                }
       
            }
            function send($to, $subject, $message){
                
                $this->to=$to;
                $this->subject=$subject;
                $this->message= $this->htmlCodeStart;
                $this->message.= $message;
                $this->message.= $this->htmlCodeEnd;
                
                $wyslij = mail($this->to, $this->subject, $this->message, $this->headers);
                if($wyslij){
                    echo "<div class=\"komunikat\" id=\"komunikat\">Wiadomość wysłana.</div>";
                    
                }
            }

        }
        
        