<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserProfileRepository")
 */
class UserProfile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="userProfile", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserProfileMedia", mappedBy="profile", orphanRemoval=true)
     */
    private $userProfileMedia;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UserProfileMedia", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $mainPicture;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    public function __construct()
    {
        $this->userProfileMedia = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|UserProfileMedia[]
     */
    public function getUserProfileMedia(): Collection
    {
        return $this->userProfileMedia;
    }

    public function addUserProfileMedium(UserProfileMedia $userProfileMedium): self
    {
        if (!$this->userProfileMedia->contains($userProfileMedium)) {
            $this->userProfileMedia[] = $userProfileMedium;
            $userProfileMedium->setProfile($this);
        }

        return $this;
    }

    public function removeUserProfileMedium(UserProfileMedia $userProfileMedium): self
    {
        if ($this->userProfileMedia->contains($userProfileMedium)) {
            $this->userProfileMedia->removeElement($userProfileMedium);
            // set the owning side to null (unless already changed)
            if ($userProfileMedium->getProfile() === $this) {
                $userProfileMedium->setProfile(null);
            }
        }

        return $this;
    }

    public function getMainPicture(): ?UserProfileMedia
    {
        return $this->mainPicture;
    }

    public function setMainPicture(?UserProfileMedia $mainPicture): self
    {
        $this->mainPicture = $mainPicture;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }
}
