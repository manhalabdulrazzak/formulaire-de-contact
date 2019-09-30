<?php
namespace App\Controller;

use App\Form\ContactType;
use App\Notification\ContactNoti;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController ;
use Symfony\Component\HttpFoundation\Request;

class ContactFController extends  AbstractController
{

    public function index(Request $request,ContactNoti $contactNoti)
    {
        $contact = new \App\Entity\Contact();
        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
       // var_dump($form->isSubmitted());die();

        if($form->isSubmitted() and $form->isValid())
        {

            $this->addFlash('succes','Votre message a été envoyé avec success');

var_dump($form->isValid());
            $contactNoti->notify($contact);
            return$this->redirectToRoute('contact_form',
                [ "form" => $form->createView()]);
        }

        return$this->render("contactForm.html.twig",
            [ "form" => $form->createView()]);
    }
}