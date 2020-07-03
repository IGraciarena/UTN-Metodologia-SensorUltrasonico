<?php   
    namespace Controllers;

    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    class EmailController{

        private $from;
        private $pass;
        private $mailSender;

        public function __construct(){
            $this->from = "utn.arduino@gmail.com";
            $this->pass= "mabelcrocce";
            $this->mailSender = new PHPMailer();
            $this->mailSender->IsSMTP();
            $this->mailSender->SMTPAuth = true;
            $this->mailSender->Host = "smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com
            $this->mailSender->Username =$this->from; // Correo completo a utilizar
            $this->mailSender->Password =$this->pass; // Contraseña
            $this->mailSender->Port = 587; // Puerto a utilizar
            //Con estas pocas líneas iniciamos una conexión con el SMTP. Lo que ahora deberíamos hacer, es configurar el mensaje a enviar, el //From, etc.
            // Desde donde enviamos (Para mostrar)
            $this->mailSender->From = $this->from; 
            $this->mailSender->FromName = "UTN Arduino";
            $this->mailSender->IsHTML(true);
        }

        public function sendEmail($distancia,$fecha,$hora){
            
            $to = 'igraciarena@gmail.com';
            $message="Su sensor fue activado el dia:".$fecha." ".$hora." con una distancia de:".$distancia;
            $subject="Notificacion del sensor";
            $header="De: ".$this->from;
            $this->mailSender->Subject = $header;
            $this->mailSender->AddAddress($to);
            $this->mailSender->Body=$message;
            $this->mailSender->send();
        }
    }