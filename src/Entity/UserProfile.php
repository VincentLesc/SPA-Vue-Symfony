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
}
