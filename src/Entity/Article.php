<?php
declare(strict_types=1);
namespace App\Entity;

use App\Repository\ArticleRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\DBAL\Types\DecimalType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\DateType;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    use RessourceId;
    use Timestapable;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $content;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private string $image;

    /**
     * @ORM\Column(type="date")
     */
    private  $date;

    /**
     * @ORM\Column(type="date")
     */
    private  $datePublish;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private DecimalType $price;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDatePublish(): ?\DateTimeInterface
    {
        return $this->datePublish;
    }

    public function setDatePublish(\DateTimeInterface $datePublish): self
    {
        $this->datePublish = $datePublish;

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

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }


}
