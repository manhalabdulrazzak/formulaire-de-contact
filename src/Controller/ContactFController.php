<?php
namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController ;
use Symfony\Component\HttpFoundation\Request;

class ContactFController extends  AbstractController
{

    public function index(Request $request)
    {
        $contact = new \App\Entity\Contact();

        $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid())
        {
            $this->addFlash('Votre message a été envoyé avec success');

            return$this->render("contactForm.html.twig",
                [ "form" => $form->createView()]);

        }
    }
}