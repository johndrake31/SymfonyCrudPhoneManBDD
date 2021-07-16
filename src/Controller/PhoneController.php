<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Form\PhoneType;
use App\Repository\PhoneRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface as EMI;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PhoneController extends AbstractController
{
    /**
     * 
     * @Route("/phone", name="phone")
     */
    public function index(PhoneRepository $repo): Response
    {
        $phones = $repo->findAll();
        return $this->render('phone/index.html.twig', [
            'phones' => $phones,

        ]);
    }


    /**
     * 
     * @Route("/phone/new", name="new_phone")
     * @Route("/phone/edit/{id}", name="edit_phone")
     */
    public function new(Phone $phone = null, Request $req, EMI $em): Response
    {
        $creationMode = null;
        if (!$phone) {
            $creationMode = true;
            $phone = new Phone();
        }


        $form = $this->createForm(PhoneType::class, $phone);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            if ($creationMode) {
                $phone->setCreatedDate(new DateTime());
            }

            $phone = $form->getData();
            $em->persist($phone);
            $em->flush();

            if (!$creationMode) {
                return $this->redirectToRoute('show_phone', [
                    'id' => $phone->getId(),
                ]);
            }

            return $this->redirect('/phone');
        }

        return $this->render('phone/phoneForm.html.twig', [
            'phoneForm' => $form->createView(),
            'creationMode' => $creationMode,
            'phone' => $phone
        ]);
    }

    /**
     * 
     * @Route("/phone/delete/{id}", name="delete_phone")
     */
    public function delete(Phone $phone, EMI $em): Response
    {
        $em->remove($phone);
        $em->flush();
        return $this->redirect('/phone');
    }

    /**
     * 
     * @Route("/phone/{id}", name="show_phone")
     */
    public function show(Phone $phone): Response
    {
        return $this->render('phone/phone.html.twig', [
            'phone' => $phone,

        ]);
    }
}
