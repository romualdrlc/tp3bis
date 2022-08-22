<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\AddwishType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="app_add_wish")
     */
    public function addWish(Request $request): Response
    {
        $newWish = new Wish();
        $wishForm = $this->createForm(AddwishType::class,$newWish);
        $wishForm->handleRequest($request);

        if ($wishForm->isSubmitted() && $wishForm->isValid()) {
            $result = $wishForm->getData();
            //traitement en base
            $em = $this->getDoctrine()->getManager(); // recup entity manager
            $em->persist($result); //mise en cache
            $em->flush(); // execution des requetes

            $this->addFlash("message","wish ajouté !!");
            return $this->redirectToRoute('app_home');
        }

        return $this->render('form/index.html.twig',["wishForm" =>$wishForm->createView()]);
    }
}
