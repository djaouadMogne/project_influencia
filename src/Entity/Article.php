<?php
declare(strict_types=1);
namespace App\Entity;

use App\Repository\ArticleRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\DBAL\Types\DecimalType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\ArticleUpdateAt;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *           "get"={
 *                "normalization_context"={"groups"={"article_read"}}
 *           },
 *           "post"    
 *      },
 *      itemOperations={
 *         "get"={
 *               "normalization_context"={"groups"={"article_details_read"}}
 *          },
 *          "put",
 *          "patch",
 *          "delete",
 *          "put_updated_at"={
 *              "method"="PUT",
 *              "path"="/articles/{id}/updated-at",
 *              "controller"=ArticleUpdateAt::class,
 *           }            
 *  }
 * )
 
 */
class Article
{
    use ResourceId;
    use Timestapable;

    /**
     * @ORM\Column(type="string", length=40)
     * @Groups({"article_read","user_details_read","article_details_read"})
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"article_read","user_details_read","article_details_read"})
     */
    private string $content;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     * @Groups({"article_read","user_details_read","article_details_read"})
     */
    private string $image;

    /**
     * @ORM\Column(type="decimal" ,nullable=true)
     * @Groups({"article_read","user_details_read","article_details_read"})
     */

  
    private DecimalType $price;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"article_details_read"})
     */
    private User $author;

    public function __construct()
    {
        $this->createdAt= new DateTimeImmutable();
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }


    public function getPrice(): ?DecimalType
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor(User $author): self
    {
        $this->author = $author;

        return $this;
    }


}
