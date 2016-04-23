<?php
namespace Acme\Email;


class sendEmail
{
    public static function sendEmail($to, $subject, $message, $from = "")
    {
        if(strlen($from) == 0) {
            $from = getenv('SMTP_FROM');

            // Create the Transport
            $transport = \Swift_SmtpTransport::newInstance(getenv('SMTP_HOST'), getenv('SMTP_PORT'))
                ->setUsername(getenv('SMTP_USER'))
                ->setPassword(getenv('SMTP_USER'))
            ;

            // Create the Mailer using your created Transport
            $mailer = \Swift_Mailer::newInstance($transport);

            // Create a message
            $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($from)
                ->setTo($to)
                ->setBody($message, 'text/html')
            ;

            // Send the message
            $result = $mailer->send($message);

            echo "Sent mail!";


        }

    }

}