<?php

namespace App\Entity;

use App\Repository\PhoneRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=PhoneRepository::class)
 */
class Phone
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 4,
     *      minMessage = "Model name must be at least {{ limit }} characters long"
     * )
     */
    private $modelName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThan(
     *      0,
     *      message = "price has to be greater than {{ limit }}."
     * )
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *      min = 30,
     *      minMessage = "description must be at least {{ limit }} characters long"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\LessThanOrEqual(
     * 512,
     * message = "The max limit of stock is 512." )
     */
    private $stockage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @ORM\ManyToOne(targetEntity=Constructeur::class, inversedBy="phone")
     * @ORM\JoinColumn(nullable=false)
     */
    private $constructeur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModelName(): ?string
    {
        return $this->modelName;
    }

    public function setModelName(string $modelName): self
    {
        $this->modelName = $modelName;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

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

    public function getStockage(): ?int
    {
        return $this->stockage;
    }

    public function setStockage(int $stockage): self
    {
        $this->stockage = $stockage;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getConstructeur(): ?Constructeur
    {
        return $this->constructeur;
    }

    public function setConstructeur(?Constructeur $constructeur): self
    {
        $this->constructeur = $constructeur;

        return $this;
    }
}
