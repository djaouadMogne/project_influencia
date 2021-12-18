<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeInterface;
use Symfony\Component\Serializer\Annotation\Groups;

trait Timestapable
{
    /**
     * @var dateTimeInterface
     * @ORM\column(type="datetime")
     * @Groups({"user_read","article_read","user_details_read","article_details_read"})
     */
    private DateTimeInterface $createdAt;

    /**
     * @var dateTimeInterface
     * @ORM\column(type="datetime",nullable=true)
     * @Groups({"user_read","article_read","user_details_read","article_details_read"})
     */
    private DateTimeInterface $updatedAt;
   
    

   
    public function getUpdatedAt(): ?dateTimeInterface
    {
        return $this->updatedAt;
    }

 
    public function setUpdatedAt(?dateTimeInterface $updatedAt):Timestapable
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

   
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }


}
