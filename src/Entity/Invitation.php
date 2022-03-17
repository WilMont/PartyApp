<?php

namespace App\Entity;

use App\Repository\InvitationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvitationRepository::class)
 */
class Invitation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateInvitation;

    /**
     * @ORM\ManyToOne(targetEntity=Compte::class, inversedBy="invitations")
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Evenements::class, inversedBy="invitations")
     */
    private $evenement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInvitation(): ?\DateTimeInterface
    {
        return $this->dateInvitation;
    }

    public function setDateInvitation(\DateTimeInterface $dateInvitation): self
    {
        $this->dateInvitation = $dateInvitation;

        return $this;
    }

    public function getUtilisateur(): ?Compte
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Compte $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getEvenement(): ?Evenements
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenements $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }
}
