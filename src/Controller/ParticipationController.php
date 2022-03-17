<?php

namespace App\Controller;

use App\Entity\Evenements;
use App\Entity\Participation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ParticipationController extends AbstractController
{
    /**
     * @Route("/participation", name="app_participation")
     */
    public function index(): Response
    {
        return $this->render('participation/index.html.twig', [
            'controller_name' => 'ParticipationController',
        ]);
    }

    /**
     * @Route("/participationAdd/{idEvenement}", name="participation_ajouter")
     */
    public function ajouter($idEvenement): Response
    {
        $user = $this->getUser();
        
        $participation = new Participation();
        $participation->setIdUtilisateur($user);

        $evenementsRepository = $this->getDoctrine()->getRepository(Evenements::class);
        $evenement = $evenementsRepository->find($idEvenement);

        $participation->setIdEvenements($evenement);
        $dateParticipation = new \DateTime();
        $participation->setDateParticipation($dateParticipation);

        //Une connexion à la BDD par l'entity manager (em).
        $em = $this->getDoctrine()->getManager();
        $em->persist($participation);
        $em->flush();


        
        return $this->render('participation/index.html.twig', [
            'controller_name' => 'ParticipationController',
        ]);
    }
}
