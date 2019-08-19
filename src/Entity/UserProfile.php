<?php

namespace App\Entity;

use App\Entity\AppEntity\CommunityGroup;
use App\Entity\AppEntity\Ethnicity;
use App\Entity\AppEntity\MaritalStatus;
use App\Entity\AppEntity\Morphology;
use App\Entity\AppEntity\SexualPosition;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Length(
     *     max="16",
     *     maxMessage="Le titre de votre profil ne peut pas faire plus de 16 caractères."
     * )
     * @Assert\Regex(
     *     pattern="/^((?!SELECT|ALTER|CREATE|DELETE|DELETETREE|DROP|EXEC(UTE){0,1}|INSERT( +INTO){0,1}|MERGE|SELECT|UNION|UPDATE))/"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Regex(
     *     pattern="/^((?!SELECT|ALTER|CREATE|DELETE|DELETETREE|DROP|EXEC(UTE){0,1}|INSERT( +INTO){0,1}|MERGE|SELECT|UNION|UPDATE))/",
     *     message="Un ou plusieurs mots utilisés ne sont pas permis."
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="integer",
     *     message="{{value}} n'est pas un age valide."
     * )
     */
    private $age;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="integer",
     *     message="{{value}} n'est pas une taille valide."
     * )
     */
    private $height;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *     type="integer",
     *     message="{{value}} n'est pas un poids valide."
     * )
     */
    private $weight;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppEntity\MaritalStatus")
     */
    private $maritalStatus;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\AppEntity\CommunityGroup")
     */
    private $groups;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppEntity\Ethnicity")
     */
    private $ethnicity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppEntity\Morphology")
     */
    private $morphology;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AppEntity\SexualPosition")
     */
    private $sexualPosition;


    public function __construct()
    {
        $this->userProfileMedia = new ArrayCollection();
        $this->groups = new ArrayCollection();
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

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getMaritalStatus(): ?MaritalStatus
    {
        return $this->maritalStatus;
    }

    public function setMaritalStatus(?MaritalStatus $maritalStatus): self
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    /**
     * @return Collection|CommunityGroup[]
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(CommunityGroup $group): self
    {
        if (!$this->groups->contains($group)) {
            $this->groups[] = $group;
        }

        return $this;
    }

    public function removeGroup(CommunityGroup $group): self
    {
        if ($this->groups->contains($group)) {
            $this->groups->removeElement($group);
        }

        return $this;
    }

    public function getEthnicity(): ?Ethnicity
    {
        return $this->ethnicity;
    }

    public function setEthnicity(?Ethnicity $ethnicity): self
    {
        $this->ethnicity = $ethnicity;

        return $this;
    }

    public function getMorphology(): ?Morphology
    {
        return $this->morphology;
    }

    public function setMorphology(?Morphology $morphology): self
    {
        $this->morphology = $morphology;

        return $this;
    }

    public function getSexualPosition(): ?SexualPosition
    {
        return $this->sexualPosition;
    }

    public function setSexualPosition(?SexualPosition $sexualPosition): self
    {
        $this->sexualPosition = $sexualPosition;

        return $this;
    }
}
