<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AlbumRepository;

/**
 * @ORM\Entity(repositoryClass=AlbumRepository::class)
 */
class Album
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"album:read", "artist:read", "track:read", "album_genre:read", "album-artist:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Artist::class, inversedBy="albums")
     * @Groups({"album:read"})
     */
    private $artist;

    /**
     * @ORM\Column(type="string")
     * @Groups({"album:read", "artist:read", "album-artist:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({"album:read", "album-artist:read"})
     */
    private $cover;

    /**
     * @ORM\Column(type="text")
     * @Groups({"album:read", "album-artist:read"})
     */
    private $cover_small;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"album:read", "album-artist:read"})
     */
    private $popularity;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="albums")
     * 
     */
    private $genre;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"album:read", "album-artist:read"})
     */
    private $release_date;

    /**
     * @ORM\Column(type="text")
     * @Groups({"album:read"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Track::class, mappedBy="album")
     * @Groups({"album-track:read"})
     */
    private $tracks;


    
    public function __construct()
    {
        $this->genre = new ArrayCollection();
        $this->tracks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): self
    {
        $this->artist = $artist;

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

   
    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getCoverSmall(): ?string
    {
        return $this->cover_small;
    }

    public function setCoverSmall(?string $cover_small): self
    {
        $this->cover_small = $cover_small;

        return $this;
    }

   
    public function getPopularity(): ?int
    {
        return $this->popularity;
    }

    public function setPopularity(?int $popularity): self
    {
        $this->popularity = $popularity;

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genre->contains($genre)) {
            $this->genre[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genre->removeElement($genre);

        return $this;
    }

    public function getReleaseDate(): ?int
    {
        return $this->release_date;
    }

    public function setReleaseDate(?int $release_date): self
    {
        $this->release_date = $release_date;

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

    /**
     * @return Collection|Track[]
     */
    public function getTracks(): Collection
    {
        return $this->tracks;
    }

    public function addTrack(Track $track): self
    {
        if (!$this->tracks->contains($track)) {
            $this->tracks[] = $track;
            $track->setAlbum($this);
        }

        return $this;
    }

    public function removeTrack(Track $track): self
    {
        if ($this->tracks->removeElement($track)) {
            // set the owning side to null (unless already changed)
            if ($track->getAlbum() === $this) {
                $track->setAlbum(null);
            }
        }

        return $this;
    }
}
