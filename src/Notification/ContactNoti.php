<?php

namespace App\Notification;

use App\Entity\Contact;
use Twig\Environment;

class ContactNoti
{
    /*
     * @var \Swift_Mailer
     */
    private $mailer;

    /*
     * @var Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer,Environment $renderer)
    {
        $this->mailer=$mailer;
        $this->renderer= $renderer;
    }

    public function notify(Contact $contact)
    {
        $messaage= (new \Swift_Message('Demande d\'information'))
        ->setFrom('contact@ewinssi.fr')
            ->setTo('ewinssi@yahoo.fr')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderer->render('contact.html.twig',[
               'contact' =>$contact ]),'text/html');
        $this->mailer->send($messaage);
    }
}