<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeInterface;

trait Timestapable
{
    /**
     * @var dateTimeInterface
     * @ORM\column(type="datetime")
     */
    private DateTimeInterface $createdAt;

    /**
     * @var dateTimeInterface
     * @ORM\column(type="datetime",nullable=true)
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

   
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }


}
