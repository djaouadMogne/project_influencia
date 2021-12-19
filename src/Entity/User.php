<?php
declare(strict_types=1);
namespace App\Entity;

use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;

use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Api\FilterInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @ApiResource(
 *      collectionOperations={
 *           "get"={
 *                "normalization_context"={"groups"={"user_read"}}
 *           },
 *           "post"    
 *      },
 *      itemOperations={
 *         "get"={
 *               "normalization_context"={"groups"={"user_details_read"}}
 *          },
 *          "put",
 *          "patch",
 *          "delete"    
 *  }
 * )
 *  @ApiFilter(SearchFilter::class,properties={"email":"partial"})
 * @ApiFilter(DateFilter::class,properties={"createdAt"})
 * @ApiFilter(BooleanFilter::class,properties={"status"})
 *  @ApiFilter(ExistsFilter::class,properties={"UpdateAt"})
 * @UniqueEntity("email",message="this email it already used")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use ResourceId;
    use Timestapable;
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user_read","user_details_read","article_details_read"})
     * @Assert\NotBlank(message="L'email est obligatoire")
     * @Assert\Email(message="email format invalide")
     */
    private string $email;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Le mot de passe est obligatoire")
     */
    private string $password;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="author", orphanRemoval=true)
     * @Groups({"user_details_read"})
     */
    private Collection $articles;

    /**
     * @ORM\Column(type="string", length=24)
     * @Groups({"user_details_read"})
     */
    private string $theusername;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $status;

 



    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->createdAt= new DateTimeImmutable();
        $this->status=true;
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

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setAuthor($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            // set the owning side to null (unless already changed)
        
                $this->articles->removeElement($article);
            
        }

        return $this;
    }

    public function getTheusername(): ?string
    {
        return $this->theusername;
    }

    public function setTheusername(string $theusername): self
    {
        $this->theusername = $theusername;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }


}
