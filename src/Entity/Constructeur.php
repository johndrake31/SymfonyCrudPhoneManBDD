<?php

namespace App\Entity;

use App\Repository\ConstructeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ConstructeurRepository::class)
 * @UniqueEntity("name")
 */
class Constructeur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 4,
     *      minMessage = "Your first name must be at least {{ limit }} characters long"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $imageLogo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $origin;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *      min = 20,
     *      minMessage = "Your first name must be at least {{ limit }} characters long"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity=Phone::class, mappedBy="constructeur", orphanRemoval=true)
     */
    private $phone;

    public function __construct()
    {
        $this->phone = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getImageLogo(): ?string
    {
        return $this->imageLogo;
    }

    public function setImageLogo(string $imageLogo): self
    {
        $this->imageLogo = $imageLogo;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|Phone[]
     */
    public function getPhone(): Collection
    {
        return $this->phone;
    }

    public function addPhone(Phone $phone): self
    {
        if (!$this->phone->contains($phone)) {
            $this->phone[] = $phone;
            $phone->setConstructeur($this);
        }

        return $this;
    }

    public function removePhone(Phone $phone): self
    {
        if ($this->phone->removeElement($phone)) {
            // set the owning side to null (unless already changed)
            if ($phone->getConstructeur() === $this) {
                $phone->setConstructeur(null);
            }
        }

        return $this;
    }
}
