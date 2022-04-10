<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isactive;

    /**
     * @ORM\ManyToOne(targetEntity=TypeCompte::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeCompte;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="userid")
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=Curriculum::class, mappedBy="userid")
     */
    private $curricula;

    /**
     * @ORM\OneToMany(targetEntity=File::class, mappedBy="userid")
     */
    private $files;

    /**
     * @ORM\OneToMany(targetEntity=Pub::class, mappedBy="userid")
     */
    private $pubs;

    /**
     * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="userid")
     */
    private $annonces;

    /**
     * @ORM\OneToMany(targetEntity=PubVer::class, mappedBy="userid")
     */
    private $pubVers;

    /**
     * @ORM\OneToMany(targetEntity=PubHor::class, mappedBy="userid")
     */
    private $pubHors;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->curricula = new ArrayCollection();
        $this->files = new ArrayCollection();
        $this->pubs = new ArrayCollection();
        $this->annonces = new ArrayCollection();
        $this->pubVers = new ArrayCollection();
        $this->pubHors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return strtoupper($this->nom);
    }

    public function setNom(string $nom): self
    {
        $this->nom = strtoupper($nom);

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getIsactive(): ?bool
    {
        return $this->isactive;
    }

    public function setIsactive(bool $isactive): self
    {
        $this->isactive = $isactive;

        return $this;
    }

    public function getTypeCompte(): ?TypeCompte
    {
        return $this->typeCompte;
    }

    public function setTypeCompte(?TypeCompte $typeCompte): self
    {
        $this->typeCompte = $typeCompte;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setUserid($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getUserid() === $this) {
                $image->setUserid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Curriculum>
     */
    public function getCurricula(): Collection
    {
        return $this->curricula;
    }

    public function addCurriculum(Curriculum $curriculum): self
    {
        if (!$this->curricula->contains($curriculum)) {
            $this->curricula[] = $curriculum;
            $curriculum->setUserid($this);
        }

        return $this;
    }

    public function removeCurriculum(Curriculum $curriculum): self
    {
        if ($this->curricula->removeElement($curriculum)) {
            // set the owning side to null (unless already changed)
            if ($curriculum->getUserid() === $this) {
                $curriculum->setUserid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, File>
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(File $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
            $file->setUserid($this);
        }

        return $this;
    }

    public function removeFile(File $file): self
    {
        if ($this->files->removeElement($file)) {
            // set the owning side to null (unless already changed)
            if ($file->getUserid() === $this) {
                $file->setUserid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Pub>
     */
    public function getPubs(): Collection
    {
        return $this->pubs;
    }

    public function addPub(Pub $pub): self
    {
        if (!$this->pubs->contains($pub)) {
            $this->pubs[] = $pub;
            $pub->setUserid($this);
        }

        return $this;
    }

    public function removePub(Pub $pub): self
    {
        if ($this->pubs->removeElement($pub)) {
            // set the owning side to null (unless already changed)
            if ($pub->getUserid() === $this) {
                $pub->setUserid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Annonce>
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces[] = $annonce;
            $annonce->setUserid($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getUserid() === $this) {
                $annonce->setUserid(null);
            }
        }

        return $this;
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->getNom().' '.$this->getPrenom();
    }

    /**
     * @return Collection<int, PubVer>
     */
    public function getPubVers(): Collection
    {
        return $this->pubVers;
    }

    public function addPubVer(PubVer $pubVer): self
    {
        if (!$this->pubVers->contains($pubVer)) {
            $this->pubVers[] = $pubVer;
            $pubVer->setUserid($this);
        }

        return $this;
    }

    public function removePubVer(PubVer $pubVer): self
    {
        if ($this->pubVers->removeElement($pubVer)) {
            // set the owning side to null (unless already changed)
            if ($pubVer->getUserid() === $this) {
                $pubVer->setUserid(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PubHor>
     */
    public function getPubHors(): Collection
    {
        return $this->pubHors;
    }

    public function addPubHor(PubHor $pubHor): self
    {
        if (!$this->pubHors->contains($pubHor)) {
            $this->pubHors[] = $pubHor;
            $pubHor->setUserid($this);
        }

        return $this;
    }

    public function removePubHor(PubHor $pubHor): self
    {
        if ($this->pubHors->removeElement($pubHor)) {
            // set the owning side to null (unless already changed)
            if ($pubHor->getUserid() === $this) {
                $pubHor->setUserid(null);
            }
        }

        return $this;
    }
}
