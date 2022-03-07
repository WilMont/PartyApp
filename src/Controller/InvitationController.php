<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Entity\Evenements;
use App\Entity\Invitation;
use App\Form\InvitationType;
use App\Entity\Participation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InvitationController extends AbstractController
{
    /**
     * @Route("/invitation/{idEvenement}", name="invitation_add")
     */
    public function index($idEvenement, Request $request): Response
    {
        $invitation = new Invitation();
        $form = $this->createForm(InvitationType::class, $invitation);


        $evenementsRepository = $this->getDoctrine()->getRepository(Evenements::class);
        $evenement = $evenementsRepository->find($idEvenement);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $invitation = $form->getData();
            $invitation->setEvenement($evenement);
            $dateInvitation = new \Datetime();
            $invitation->setDateInvitation($dateInvitation);
           

            //Une connexion à la BDD par l'entity manager (em).
            $em = $this->getDoctrine()->getManager();
            $em->persist($invitation);
            $em->flush();

            return $this->redirectToRoute("liste_evenements");
        }
        return $this->render('invitation/index.html.twig', [
            "form" => $form->createView(),
            'titre' => 'Creation invitation',
            'evenement' => $idEvenement
        ]);
    }

     /**
     * @Route("/invitations", name="invitation_liste")
     */
    public function afficher_Liste(): Response
    {
        $user = $this->getUser();
        $evenementsRepository = $this->getDoctrine()->getRepository(Invitation::class);

        $lesInvitations = $evenementsRepository->findBy([
            "utilisateur" => $user
        ]);
        
        return $this->render('invitation/listeInvitations.html.twig', [
            "invitations" => $lesInvitations,
            
        ]);
    }

     /**
     * @Route("/invitationAccepter/{idInvitation}/{idEvenement}/{idUtilisateur}", name="invitation_accepter")
     */
    public function accepter($idInvitation,$idEvenement, $idUtilisateur): Response
    {
        $invitationRepository = $this->getDoctrine()->getRepository(Invitation::class);
        $invitation = $invitationRepository->find($idInvitation);

        $evenementsRepository = $this->getDoctrine()->getRepository(Evenements::class);
        $evenement = $evenementsRepository->find($idEvenement);

        $UserRepository = $this->getDoctrine()->getRepository(Compte::class);
        $utilisateur = $UserRepository->find($idUtilisateur);

        $dateParticipation = new \Datetime();

        $participation = new Participation;
        $participation->setIdUtilisateur($utilisateur);
        $participation->setIdEvenements($evenement);
        $participation->setDateParticipation($dateParticipation);

        // Supprimer l'invitation 
        $em = $this->getDoctrine()->getManager();
        $em->remove($invitation);
        $em->flush();
        // Ajoute une participation
        $em = $this->getDoctrine()->getManager();
        $em->persist($participation);
        $em->flush();


        
        return $this->redirectToRoute("liste_evenements");
    }

    /**
     * @Route("/invitationsRefuser/{idInvitation}", name="invitation_refuser")
     */
    public function refuser($idInvitation): Response
    {
        $invitationRepository = $this->getDoctrine()->getRepository(Invitation::class);
        $invitation = $invitationRepository->find($idInvitation);

        $em = $this->getDoctrine()->getManager();
        $em->remove($invitation);
        $em->flush();
        
        return $this->redirectToRoute("liste_evenements");
    }
}
