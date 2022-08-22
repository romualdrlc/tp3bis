<?php

namespace App\Controller;

use App\Entity\Wish;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish", name="app_wish_list")
     */
    public function listWish(): Response
    {
        //recup table Person en base
        $repoWish = $this->getDoctrine()->getRepository(Wish::class); // recup entity manager et repo

        $liste = $repoWish->findAll();
        return $this->render('wish/list.html.twig', [
            'listes' => $liste
        ]);
    }
    /**
     * @Route("/wish/detail/{id}", name="app_wish_detail")
     */
    public function detailWish($id): Response
    {
        $repoWishDetail = $this->getDoctrine()->getRepository(Wish::class);
        $detailWish = $repoWishDetail->find($id);
        return $this->render('wish/detail.html.twig', [
            'detailWish' => $detailWish
        ]);
    }
    /**
     * @Route("/delete/{id}", name="app_delete_id")
     */
    public function deleteId($id): Response
    {
        $entityManager=$this->getDoctrine()->getManager();
        $single_wish=$this->getDoctrine()->getRepository(Wish::class)->findOneBy(['id'=>$id]);
        $entityManager->remove($single_wish);
        $entityManager->flush();
        return $this->redirectToRoute('app_wish_list');
    }

    /**
     * @Route("/initwish", name="app_init_wish")
     */
    public function initWish(): Response
    {
        //instancie plusieurs wish de depart
        $liste1 = new Wish();
        $liste2 = new Wish();
        $liste3 = new Wish();
        $liste1->setTitle("saut en mongolfiere");
        $liste1->setDescription("aller faire un saut en mongolfiere");
        $liste1->setAuthor("romuald");
        $liste2->setTitle("aller faire un saut en parachute");
        $liste2->setDescription("aller faire un saut en mongolfiere");
        $liste2->setAuthor("romuald");
        $liste3->setTitle("vol en avion");
        $liste3->setDescription("aller faire vol en avion de chasse");
        $liste3->setAuthor("romuald");
        //traitement en base
        $em = $this->getDoctrine()->getManager(); // recup entity manager
        $em->persist($liste1); //mise en cache
        $em->persist($liste2); //mise en cache
        $em->persist($liste3); //mise en cache
        $em->flush(); // execution des requetes

        //regroupement des wish dans un tab
        $listWish = [$liste1,$liste2,$liste3];
        return $this->render('wish/list.html.twig', [
            'listes' => $listWish
        ]);
    }

}
