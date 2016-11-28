<?php

class SendController
{
    public function __construct()
    {
        if (!Request::isPost()) die();
    }

    public function indexAction()
    {

    }

    /**
     * Send email from contact form.
     */
    public function contactAction()
    {
        $alkaTechEmail = "kubaciach@gmial.com";

        // ~

        /* Params */
        $name = Request::getPost('name', 'escape string');
        $email = Request::getPost('email', 'escape string');
        $phone = Request::getPost('phone', 'escape string');
        $message = Request::getPost('message', 'escape string');
        $subject = Request::getPost('subject', 'escape string');

        // ~

        $response['success'] = false;

        // ~

        if (!$email || !$message || !$subject || !$name || !$phone) {
            $response['message'] = 'Uzupełnij wszystkie pola';
        } else {
            $reply = $email;

            /* Build message */
            $headers = 'From: Alka-tech <' . $alkaTechEmail . '>' . "\r\n";
            $headers .= 'Reply-To: <' . $email . '>' . "\r\n";
            $headers .= 'X-Mailer: PHP/' . phpversion();
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

            $html = '<table>';
            $html .= '<tr><td>Imię i nazwisko: </td><td>' .$name . '</td></tr>';
            $html .= '<tr><td>Adres e-mail: </td><td>' . $email . '</td></tr>';
            $html .= '<tr><td>Numer telefonu: </td><td>' . $phone . '</td></tr>';
            $html .= '<tr><td>Temat: </td><td>' . $subject . '</td></tr>';
            $html .= '<tr><td>Wiadomość: </td><td>' . $message . '</td></tr>';
            $html .= '</table>';

            // ~
            
            mail($alkaTechEmail, "Formularz kontaktowy", $html, $headers);

            // ~

            $response['success'] = true;
            $response['message'] = 'Wiadomość została wysłana pomyślnie';
        }

        echo json_encode($response);
    }
}