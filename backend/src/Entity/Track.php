<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\TrackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Album;
/**
 * @ORM\Entity(repositoryClass=TrackRepository::class)
 */
class Track
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"track:read","album:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"track:read","album:read"})
     */
    private $mp3;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"track:read","album:read"})
     */
    private $duration;

    /**
     * @ORM\ManyToOne(targetEntity=Album::class, inversedBy="tracks")
     * @Groups({"track:read","album:read"})
     */
    private $album;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"track:read","album:read"})
     */
    private $track_no;

    public function __construct()
    {
        $this->album = new ArrayCollection();
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

    public function getMp3(): ?string
    {
        return $this->mp3;
    }

    public function setMp3(string $mp3): self
    {
        $this->mp3 = $mp3;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): self
    {
        $this->album = $album;

        return $this;
    }

    public function getTrackNo(): ?int
    {
        return $this->track_no;
    }

    public function setTrackNo(int $track_no): self
    {
        $this->track_no = $track_no;

        return $this;
    }

   
}
