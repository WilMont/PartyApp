<?php

namespace App\Controller;

use App\Entity\Compte;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="app_profil")
     */
    public function index(): Response
    {
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }

    /**
     * @Route("/profil/{id_compte}", name="profil")
     */
    public function profil($id_compte, Request $request)
    {
        $user = $this->getUser();

        $comptesRepository = $this->getDoctrine()->getRepository(Compte::class);
        $compte = $comptesRepository->find($id_compte);

        return $this->render('profil/profilPage.html.twig', [
            'titre' => "Profil de " . $compte->getUsername(),
            'compte' => $compte,
        ]);
    }
}
