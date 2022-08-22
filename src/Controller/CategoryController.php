<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="app_category")
     */
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
    /**
     * @Route("/category/init", name="app_category_init")
     */
    public function init(): Response
    {
        $cat1 = new Category();
        $cat2 = new Category();
        $cat3 = new Category();
        $cat4 = new Category();
        $cat5 = new Category();
        $cat1->setName("Travel & Adventure");
        $cat2->setName("Sport");
        $cat3->setName("Entertainment");
        $cat4->setName("Human Relations");
        $cat5->setName("Others");
        $em = $this->getDoctrine()->getManager(); // recup entity manager
        $em->persist($cat1);
        $em->persist($cat2);
        $em->persist($cat3);
        $em->persist($cat4);
        $em->persist($cat5);
        $em->flush();

        return $this->redirectToRoute("app_home");
    }
}
