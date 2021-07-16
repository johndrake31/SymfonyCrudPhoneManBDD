<?php

namespace App\Controller;

use App\Entity\Constructeur;
use App\Form\ConstructeurType;
use App\Repository\PhoneRepository;
use App\Repository\ConstructeurRepository;
use Doctrine\ORM\EntityManagerInterface as EMI;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConstructeurController extends AbstractController
{
    /**
     *
     * @Route("/constructeur", name="constructeur")
     */
    public function index(ConstructeurRepository $repo): Response
    {
        $constructeurs = $repo->findAll();


        return $this->render('constructeur/index.html.twig', [
            'constructeurs' => $constructeurs
        ]);
    }


    /**
     * 
     * @Route("/constructeur/new", name="new_constructeur")
     * @Route("/constructeur/edit/{id}", name="edit_constructeur")
     */
    public function new(Constructeur $constructeur = null, Request $req, EMI $em): Response
    {
        $creationMode = null;
        if (!$constructeur) {
            $creationMode = true;
            $constructeur = new Constructeur();
        }

        $form = $this->createForm(ConstructeurType::class, $constructeur);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated

            $constructeur = $form->getData();
            $em->persist($constructeur);
            $em->flush();

            if (!$creationMode) {
                return $this->redirectToRoute('show_constructeur', [
                    'id' => $constructeur->getId(),
                ]);
            }

            return $this->redirect('/constructeur');
        }

        return $this->render('constructeur/constructeurForm.html.twig', [
            'constructeurForm' => $form->createView(),
        ]);
    }





    /**
     * 
     * @Route("/constructeur/delete/{id}", name="delete_constructeur")
     */
    public function delete(Constructeur $constructeur, EMI $em): Response
    {
        $em->remove($constructeur);
        $em->flush();
        return $this->redirect('/constructeur');
    }

    /**
     * 
     * @Route("/constructeur/{id}", name="show_constructeur")
     */
    public function show(Constructeur $constructeur): Response
    {
        return $this->render('constructeur/show.html.twig', [
            'constructeur' => $constructeur,

        ]);
    }
}
