<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticipationRepository::class)
 */
class Participation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Compte::class, inversedBy="participations")
     */
    private $idUtilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Evenements::class, inversedBy="participations")
     */
    private $idEvenements;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateParticipation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtilisateur(): ?Compte
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(?Compte $idUtilisateur): self
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    public function getIdEvenements(): ?Evenements
    {
        return $this->idEvenements;
    }

    public function setIdEvenements(?Evenements $idEvenements): self
    {
        $this->idEvenements = $idEvenements;

        return $this;
    }

    public function getDateParticipation(): ?\DateTimeInterface
    {
        return $this->dateParticipation;
    }

    public function setDateParticipation(\DateTimeInterface $dateParticipation): self
    {
        $this->dateParticipation = $dateParticipation;

        return $this;
    }
}
