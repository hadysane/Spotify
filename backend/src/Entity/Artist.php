<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=ArtistRepository::class)
 */
class Artist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"artist:read", "album:read", "album-artist:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"artist:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({"artist:read"})
     */
    private $bio;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"artist:read"})
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity=Album::class, mappedBy="artist")
     * @Groups({"artist:read"})
     */
    private $albums;

    /**
     * @ORM\Column(type="text")
     * @Groups({"artist:read"})
     */
    private $description;


    public function __construct()
    {
        $this->albums = new ArrayCollection();
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

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection|Album[]
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public function addAlbum(Album $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums[] = $album;
            $album->setArtist($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): self
    {
        if ($this->albums->removeElement($album)) {
            // set the owning side to null (unless already changed)
            if ($album->getArtist() === $this) {
                $album->setArtist(null);
            }
        }

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
}
