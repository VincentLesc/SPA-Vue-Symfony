<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserProfileMediaRepository")
 */
class UserProfileMedia
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime(
     *     message="{{value}} n'est pas une date valide."
     * )
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=126)
     * @Assert\Regex(
     *     pattern="/(.jpg|.png|.jpeg|.gif){1}/"
     * )
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserProfile", inversedBy="userProfileMedia")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profile;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\Type(
     *     type="boolean",
     *     message="{{value}} n'est pas une valeur valide."
     * )
     */
    private $isPublic;

    public function __construct()
    {
        $this->setIsPublic(true);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getProfile(): ?UserProfile
    {
        return $this->profile;
    }

    public function setProfile(?UserProfile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function getIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(?bool $isPublic): self
    {
        $this->isPublic = $isPublic;

        return $this;
    }
}
