<?php

namespace App\Entity;

use App\Repository\FamilyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FamilyRepository::class)]
class Family
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $banner = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'family', targetEntity: GotCharacter::class, orphanRemoval: true)]
    private Collection $gotCharacters;

    public function __construct()
    {
        $this->gotCharacters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBanner(): ?string
    {
        return $this->banner;
    }

    public function setBanner(string $banner): self
    {
        $this->banner = $banner;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $gotCharacter->setFamily($this);
        }

        return $this;
    }

    public function removeGotCharacter(GotCharacter $gotCharacter): self
    {
        if ($this->gotCharacters->removeElement($gotCharacter)) {
            // set the owning side to null (unless already changed)
            if ($gotCharacter->getFamily() === $this) {
                $gotCharacter->setFamily(null);
            }
        }

        return $this;
    }
}
