<?php

require_once 'PHPMailer/class.phpmailer.php';

class MailSender {

    private $destino;
    private $assunto;
    private $mensagem;

    public function __construct() {
        $this->destino = "";
        $this->assunto = "";
        $this->mensagem = "";
    }

    public function setDestino($destino) {
        $this->destino = $destino;
    }

    public function setAssunto($assunto) {
        $this->assunto = $assunto;
    }

    public function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    public function enviarMensagem() {

        $this->mensagem .= "<br><br><strong>(Esta é uma mensagem automática, não é necessário respondê-la)</strong>";
        
        $mail = new PHPMailer();

        $mail->Mailer = "smtp";
        $mail->IsHTML(true);
        $mail->CharSet = "utf-8";
        $mail->SMTPSecure = "tls";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = "587";
        $mail->SMTPAuth = "true";
        $mail->Username = "ppgcmsor@gmail.com";
        $mail->Password = "Ppgcmsor2009";
        $mail->From = "ppgcmsor@gmail.com";
        $mail->FromName = "PPGCM";
        $mail->AddAddress($this->destino);
        $mail->Subject = $this->assunto;
        $mail->Body = $this->mensagem;

        return $mail->Send();
    }
}

?>
