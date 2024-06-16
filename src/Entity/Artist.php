<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Votre pseudonyme doit comporter au moins {{ limit }} caractères',
        maxMessage: 'Votre pseudonyme ne peut pas dépasser {{ limit }} caractères',
    )]
    private ?string $nickname = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column]
    private ?bool $professional = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Votre ville doit comporter au moins {{ limit }} caractères',
        maxMessage: 'Votre ville ne peut pas dépasser {{ limit }} caractères',
    )]
    private ?string $city = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Votre pays doit comporter au moins {{ limit }} caractères',
        maxMessage: 'Votre pays ne peut pas dépasser {{ limit }} caractères',
    )]
    private ?string $country = null;

    #[ORM\Column(length: 13)]
    #[Assert\Length(
        min: 10,
        max: 13,
        minMessage: 'Votre numéro de téléphone doit comporter au moins {{ limit }} caractères',
        maxMessage: 'Votre numéro de téléphone ne peut pas dépasser {{ limit }} caractères',
    )]
    private ?string $phone = null;

    #[ORM\Column(length: 180)]
    #[Assert\Email(
        message: 'L\'adresse e-mail "{{ value }}" n\'est pas valide. Veuillez réessayer.',
    )]
    private ?string $mail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;
    
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $bio = null;

    #[ORM\Column(nullable: true)]
    private ?int $birthyear = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'artists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'artists')]
    private Collection $tag;

    /**
     * @var Collection<int, Favorite>
     */
    #[ORM\ManyToMany(targetEntity: Favorite::class, inversedBy: 'artists')]
    private Collection $favorite;

    /**
     * @var Collection<int, MusicalStyle>
     */
    #[ORM\ManyToMany(targetEntity: MusicalStyle::class, inversedBy: 'artists')]
    #[ORM\JoinColumn(nullable: false)]
    private Collection $musicalStyle;

    /**
     * @var Collection<int, Instrument>
     */
    #[ORM\ManyToMany(targetEntity: Instrument::class, inversedBy: 'artists')]
    #[ORM\JoinColumn(nullable: false)]
    private Collection $instrument;

    /**
     * @var Collection<int, Set>
     */
    #[ORM\ManyToMany(targetEntity: Set::class, inversedBy: 'artists')]
    private Collection $ensemble;

    /**
     * @var Collection<int, Performance>
     */
    #[ORM\ManyToMany(targetEntity: Performance::class, inversedBy: 'artists')]
    private Collection $performance;

    /**
     * @var Collection<int, Picture>
     */
    #[ORM\ManyToMany(targetEntity: Picture::class, inversedBy: 'artists')]
    private Collection $picture;

    /**
     * @var Collection<int, Video>
     */
    #[ORM\ManyToMany(targetEntity: Video::class, inversedBy: 'artists')]
    private Collection $video;

    /**
     * @var Collection<int, Audio>
     */
    #[ORM\ManyToMany(targetEntity: Audio::class, inversedBy: 'artists')]
    private Collection $audio;

    /**
     * @var Collection<int, Website>
     */
    #[ORM\ManyToMany(targetEntity: Website::class, inversedBy: 'artists')]
    private Collection $website;

    /**
     * @var Collection<int, SocialNetwork>
     */
    #[ORM\ManyToMany(targetEntity: SocialNetwork::class, inversedBy: 'artists')]
    private Collection $socialNetwork;

    /**
     * @var Collection<int, MusicPlatform>
     */
    #[ORM\ManyToMany(targetEntity: MusicPlatform::class, inversedBy: 'artists')]
    private Collection $musicPlatform;

    /**
     * @var Collection<int, EventPlatform>
     */
    #[ORM\ManyToMany(targetEntity: EventPlatform::class, inversedBy: 'artists')]
    private Collection $eventPlatform;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'artist')]
    private Collection $reviews;

    #[ORM\ManyToOne(inversedBy: 'artists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    /**
     * @var Collection<int, Event>
     */
    #[ORM\ManyToMany(targetEntity: Event::class, inversedBy: 'artists')]
    private Collection $events;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
        $this->favorite = new ArrayCollection();
        $this->musicalStyle = new ArrayCollection();
        $this->instrument = new ArrayCollection();
        $this->ensemble = new ArrayCollection();
        $this->performance = new ArrayCollection();
        $this->picture = new ArrayCollection();
        $this->video = new ArrayCollection();
        $this->audio = new ArrayCollection();
        $this->website = new ArrayCollection();
        $this->socialNetwork = new ArrayCollection();
        $this->musicPlatform = new ArrayCollection();
        $this->eventPlatform = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): static
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function isProfessionnal(): ?bool
    {
        return $this->professional;
    }

    public function setProfessional(bool $professional): static
    {
        $this->professional = $professional;

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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    public function getBirthyear(): ?string
    {
        return $this->birthyear;
    }

    public function setBirthyear(?string $birthyear): static
    {
        $this->birthyear = $birthyear;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tag->contains($tag)) {
            $this->tag->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tag->removeElement($tag);

        return $this;
    }

    /**
     * @return Collection<int, Favorite>
     */
    public function getFavorite(): Collection
    {
        return $this->favorite;
    }

    public function addFavorite(Favorite $favorite): static
    {
        if (!$this->favorite->contains($favorite)) {
            $this->favorite->add($favorite);
        }

        return $this;
    }

    public function removeFavorite(Favorite $favorite): static
    {
        $this->favorite->removeElement($favorite);

        return $this;
    }

    /**
     * @return Collection<int, MusicalStyle>
     */
    public function getMusicalStyle(): Collection
    {
        return $this->musicalStyle;
    }

    public function addMusicalStyle(MusicalStyle $musicalStyle): static
    {
        if (!$this->musicalStyle->contains($musicalStyle)) {
            $this->musicalStyle->add($musicalStyle);
        }

        return $this;
    }

    public function removeMusicalStyle(MusicalStyle $musicalStyle): static
    {
        $this->musicalStyle->removeElement($musicalStyle);

        return $this;
    }

    /**
     * @return Collection<int, Instrument>
     */
    public function getInstrument(): Collection
    {
        return $this->instrument;
    }

    public function addInstrument(Instrument $instrument): static
    {
        if (!$this->instrument->contains($instrument)) {
            $this->instrument->add($instrument);
        }

        return $this;
    }

    public function removeInstrument(Instrument $instrument): static
    {
        $this->instrument->removeElement($instrument);

        return $this;
    }

    /**
     * @return Collection<int, Set>
     */
    public function getEnsemble(): Collection
    {
        return $this->ensemble;
    }

    public function addEnsemble(Set $ensemble): static
    {
        if (!$this->ensemble->contains($ensemble)) {
            $this->ensemble->add($ensemble);
        }

        return $this;
    }

    public function removeEnsemble(Set $ensemble): static
    {
        $this->ensemble->removeElement($ensemble);

        return $this;
    }

    /**
     * @return Collection<int, Performance>
     */
    public function getPerformance(): Collection
    {
        return $this->performance;
    }

    public function addPerformance(Performance $performance): static
    {
        if (!$this->performance->contains($performance)) {
            $this->performance->add($performance);
        }

        return $this;
    }

    public function removePerformance(Performance $performance): static
    {
        $this->performance->removeElement($performance);

        return $this;
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getPicture(): Collection
    {
        return $this->picture;
    }

    public function addPicture(Picture $picture): static
    {
        if (!$this->picture->contains($picture)) {
            $this->picture->add($picture);
        }

        return $this;
    }

    public function removePicture(Picture $picture): static
    {
        $this->picture->removeElement($picture);

        return $this;
    }

    /**
     * @return Collection<int, Video>
     */
    public function getVideo(): Collection
    {
        return $this->video;
    }

    public function addVideo(Video $video): static
    {
        if (!$this->video->contains($video)) {
            $this->video->add($video);
        }

        return $this;
    }

    public function removeVideo(Video $video): static
    {
        $this->video->removeElement($video);

        return $this;
    }

    /**
     * @return Collection<int, Audio>
     */
    public function getAudio(): Collection
    {
        return $this->audio;
    }

    public function addAudio(Audio $audio): static
    {
        if (!$this->audio->contains($audio)) {
            $this->audio->add($audio);
        }

        return $this;
    }

    public function removeAudio(Audio $audio): static
    {
        $this->audio->removeElement($audio);

        return $this;
    }

    /**
     * @return Collection<int, Website>
     */
    public function getWebsite(): Collection
    {
        return $this->website;
    }

    public function addWebsite(Website $website): static
    {
        if (!$this->website->contains($website)) {
            $this->website->add($website);
        }

        return $this;
    }

    public function removeWebsite(Website $website): static
    {
        $this->website->removeElement($website);

        return $this;
    }

    /**
     * @return Collection<int, SocialNetwork>
     */
    public function getSocialNetwork(): Collection
    {
        return $this->socialNetwork;
    }

    public function addSocialNetwork(SocialNetwork $socialNetwork): static
    {
        if (!$this->socialNetwork->contains($socialNetwork)) {
            $this->socialNetwork->add($socialNetwork);
        }

        return $this;
    }

    public function removeSocialNetwork(SocialNetwork $socialNetwork): static
    {
        $this->socialNetwork->removeElement($socialNetwork);

        return $this;
    }

    /**
     * @return Collection<int, MusicPlatform>
     */
    public function getMusicPlatform(): Collection
    {
        return $this->musicPlatform;
    }

    public function addMusicPlatform(MusicPlatform $musicPlatform): static
    {
        if (!$this->musicPlatform->contains($musicPlatform)) {
            $this->musicPlatform->add($musicPlatform);
        }

        return $this;
    }

    public function removeMusicPlatform(MusicPlatform $musicPlatform): static
    {
        $this->musicPlatform->removeElement($musicPlatform);

        return $this;
    }

    /**
     * @return Collection<int, EventPlatform>
     */
    public function getEventPlatform(): Collection
    {
        return $this->eventPlatform;
    }

    public function addEventPlatform(EventPlatform $eventPlatform): static
    {
        if (!$this->eventPlatform->contains($eventPlatform)) {
            $this->eventPlatform->add($eventPlatform);
        }

        return $this;
    }

    public function removeEventPlatform(EventPlatform $eventPlatform): static
    {
        $this->eventPlatform->removeElement($eventPlatform);

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setArtist($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getArtist() === $this) {
                $review->setArtist(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        $this->events->removeElement($event);

        return $this;
    }
}
