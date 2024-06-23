<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(
        min: 2,
        max: 30,
        minMessage: 'Le lieu de l\'évènement doit comporter au moins {{ limit }} caractères',
        maxMessage: 'Le lieu de l\'évènement ne peut pas dépasser {{ limit }} caractères',
    )]
    private ?string $location = null;

    #[ORM\Column(length: 30)]
    #[Assert\Length(
        min: 2,
        max: 30,
        minMessage: 'le titre de l\'évènement doit comporter au moins {{ limit }} caractères',
        maxMessage: 'le titre de l\'évènement ne peut pas dépasser {{ limit }} caractères',
    )]

    private ?string $title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(
        min: 10,
        max: 15,
        minMessage: 'L\'adresse de l\'évènement doit comporter au moins {{ limit }} caractères',
        maxMessage: 'L\'adresse de l\'évènement ne peut pas dépasser {{ limit }} caractères',
    )]
    private ?string $address = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'La ville de l\'évènement doit comporter au moins {{ limit }} caractères',
        maxMessage: 'La ville de l\'évènement ne peut pas dépasser {{ limit }} caractères',
    )]
    private ?string $city = null;

    #[ORM\Column(length: 5, nullable: true)]
    #[Assert\Length(
        exactly: 5,
        exactMessage: 'le code postal de l\'évènement doit comporter exactement {{ limit }} caractères',
        )]
    private ?string $zip = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Le pays où doit se dérouler de l\'évènement doit comporter au moins {{ limit }} caractères',
        maxMessage: 'Le pays où doit se dérouler de l\'évènement ne peut pas dépasser {{ limit }} caractères',
    )]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $link = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    /**
     * @var Collection<int, Artist>
     */
    #[ORM\ManyToMany(targetEntity: Artist::class, mappedBy: 'events')]
    private Collection $artists;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(?string $zip): static
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): static
    {
        $this->link = $link;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection<int, Artist>
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): static
    {
        if (!$this->artists->contains($artist)) {
            $this->artists->add($artist);
            $artist->addEvent($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): static
    {
        if ($this->artists->removeElement($artist)) {
            $artist->removeEvent($this);
        }

        return $this;
    }
}
