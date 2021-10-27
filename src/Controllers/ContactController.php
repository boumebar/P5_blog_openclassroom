<?php


namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class ContactController extends Controller
{


    /**
     * 
     */
    public function contact(): void
    {
        $_SESSION['message'] = [];
        if (!empty($_POST)) {

            if (!isset($_POST['name']) || empty($_POST['name'])) {
                $_SESSION['message']['erreur'][] = "Le nom est obligatoire";
            };
            if (!isset($_POST['email']) || empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['message']['erreur'][] = "Un email valide est obligatoire";
            };
            if (isset($_POST['phone']) && !empty($_POST['phone'])) {
                $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
                $phone_to_check = str_replace("-", "", $phone);
                $firstNumber = (int)substr($phone_to_check, 0, 1);

                if ($firstNumber !== 0 || strlen($phone_to_check) < 10 || strlen($phone_to_check) > 10) {
                    $_SESSION['message']['erreur'][] = "Veuillez entrer un numero valide (10 chiffres commençant par 0)";
                }
            };

            if (!isset($_POST['message']) || empty($_POST['message'])) {
                $_SESSION['message']['erreur'][] = "Un message est obligatoire";
            };

            if (isset($_SESSION['message']['erreur']) && !empty($_SESSION['message']['erreur'])) {
                $this->render("contact/contact", ['post' => $_POST]);
                exit();
            };


            $mail = new PHPMailer(true);
            $mail->Charset = "UTF-8";
            $mail->Encoding = 'base64';
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'ea70c01399f8f4';
            $mail->Password = '4b7d4db73abae6';

            $mail->setFrom($_POST['email'], $_POST['name']);
            $mail->addAddress("boumediene@gmail.com", "Boumediene");

            $mail->Subject = 'Test Mail';
            $mail->isHTML(true);


            $mail->Body = "
            <p>Demande de contact !</p>
            <ul>
                <li>Nom :" . $_POST['name'] . "</li>
                <li>Email :" . $_POST['email'] . "</li>
                <li>Telephone :" . $_POST['phone']  . "</li>
                <li>Demande :" . $_POST['message'] . " </li>
            </ul>
        ";

            if ($mail->send()) {
                $_SESSION['message']['valide'][] = "Merci ! Votre message a bien été envoyé";
                $this->render("contact/contact");
            } else {
                echo $mail->ErrorInfo;
            }
        } else
            $this->render('contact/contact');
    }
}
