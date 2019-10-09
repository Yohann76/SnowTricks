<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MediaRepository")
 */
class Media
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tricks", inversedBy="media")
     */
    private $tricks;

    private $Embed;

    public function getEmbed()
    {
        return $this->Embed;
    }

    public function setEmbed($Embed): void
    {
        $this->Embed = $Embed;
    }

    private $file;

    /**
     * @ORM\Column(type="boolean" , options={"default":false} )
     */
    private $thumbnail;

    /**
     * @return mixed
     */

    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file): void
    {
        $this->file = $file;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }



    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getTricks(): ?Tricks
    {
        return $this->tricks;
    }

    public function setTricks(?Tricks $tricks): self
    {
        $this->tricks = $tricks;

        return $this;
    }

    public function getThumbnail(): ?bool
    {
        return $this->thumbnail;
    }

    public function setThumbnail(bool $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

}
