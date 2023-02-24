<?php
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;

   require 'phpmailer/src/Exception.php';
   require 'phpmailer/src/PHPMailer.php';

   $mail = new PHPMailer(true);
   $mail->CharSet = 'UTF-8';
   $mail->setLanguage('ru', 'phpmailer/language/');
   $mail->IsHTML(true);

   //От кого письмо
   $mail->setFrom('danyawolf382@gmail.com', 'Студия Танцев');
   //Кому отправить
   $mail->addAddress('pendulumplay@gmail.com');
   //Тема письма
   $mail->Subject = 'Запис на пробне тренування "Cтудия Танцев"';

   //Тело письма
   $body = '<h1>Запис на пробне тренування!</h1>';

   if (trim(!empty($_POST['name']))) {
      $body.='<p><strong>Імя одного з батьків:</strong> '.$_POST['name'].'</p>';
   }
   if (trim(!empty($_POST['phone']))) {
      $body.='<p><strong>Телефон одного з батьків:</strong> '.$_POST['phone'].'</p>';
   }
   if (trim(!empty($_POST['age']))) {
      $body.='<p><strong>Вік дитини:</strong> '.$_POST['age'].'</p>';
   }

   $mail->Body = $body;

   //ОТправляем
   if (!$mail->send()) {
      $message = 'Помилка';
   } else {
      $message = 'Дані надіслані!';
   }

   $response = ['message' => $message];

   header('Content-type: application/json');
   echo json_encode($response);
?>