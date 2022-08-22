<?php

namespace App\Controller;

use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(): Response
    {
        return $this->redirectToRoute('app_home');
    }
    /**
     * @Route("/create-person", name="app_create_person")
     */
    public function createPerson(): Response
    {
        //instan,cie une personne
       $person = new Person();
       $person->setName("LE CORROLLER");
       $person->setFirstname("Romuald");
       $person->setAge(44);
       //traitement en base
        $em = $this->getDoctrine()->getManager(); // recup entity manager
        $em->persist($person); //mise en cache
        $em->flush(); // execution des requetes
       return new Response("test fifni");
    }
    /**
     * @Route("/select-person", name="app_select_person")
     */
    public function selectPerson(): Response
    {
        //recup table Person en base
        $repoPerson = $this->getDoctrine()->getRepository(Person::class); // recup entity manager et repo
        $person = $repoPerson->find(2);
        //return new Response("Person : ". $person->getName());
        return new Response("Person : ". $person); // zaevc le toString
    }

    /**
     * @Route("/home", name="app_home")
     */
    public function home(): Response
    {
        $tab = ['nom' => "romu",'prenom'=> "LE CORROLLER",'age'=>44];
        return $this->render('home/index.html.twig',['toto' => $tab]);
    }
}
