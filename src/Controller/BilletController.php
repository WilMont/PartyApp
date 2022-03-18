<?php

namespace App\Controller;

use App\Entity\Evenements;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BilletController extends AbstractController
{
    /**
     * @Route("/billet/{id}", name="app_billet")
     */
    public function index($id): Response
    {
        $evenementsRepository = $this->getDoctrine()->getRepository(Evenements::class);

        $evenement = $evenementsRepository->find($id);

        return $this->render('billet/index.html.twig', [
            'evenement' => $evenement
        ]);
    }

    /**
     * @Route("/billet", name="liste_billet")
     */
    public function listeBillet(): Response
    {
        $user = $this->getUser();
        $participations = $user->getParticipations();
        $evenementsRepository = $this->getDoctrine()->getRepository(Evenements::class);
        $listeEvenement = array();
        foreach($participations as &$participation )
        {
            $evenement = $evenementsRepository->find($participation->getIdEvenements()->getId());
            array_push($listeEvenement,$evenement);
        }

        return $this->render('billet/listeBillet.html.twig', [
            'listeEvenement' => $listeEvenement
        ]);
    }
}
