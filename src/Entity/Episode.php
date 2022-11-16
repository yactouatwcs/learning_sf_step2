<?php

namespace App\Entity;

use App\Repository\EpisodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EpisodeRepository::class)]
class Episode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $number = null;

    #[ORM\ManyToMany(targetEntity: GotCharacter::class, inversedBy: 'episodes')]
    private Collection $gotCharacters;

    public function __construct()
    {
        $this->gotCharacters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return Collection<int, GotCharacter>
     */
    public function getGotCharacters(): Collection
    {
        return $this->gotCharacters;
    }

    public function addGotCharacter(GotCharacter $gotCharacter): self
    {
        if (!$this->gotCharacters->contains($gotCharacter)) {
            $this->gotCharacters->add($gotCharacter);
        }

        return $this;
    }

    public function removeGotCharacter(GotCharacter $gotCharacter): self
    {
        $this->gotCharacters->removeElement($gotCharacter);

        return $this;
    }
}
