<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 *
 * @ApiFilter(DateFilter::class, properties={"publicationDate"})
 * @ApiFilter(RangeFilter::class, properties={"rating"})
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "author": "ipartial", "body": "ipartial", "rating": "exact", "book.title": "ipartial"})
 * @ApiFilter(PropertyFilter::class)
 * @ApiFilter(OrderFilter::class,
 *      properties={
 *          "publicationDate": { "nulls_comparison": OrderFilter::NULLS_SMALLEST, "default_direction": "DESC" }
 *      }
 * )
 */
class Review
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     *
     * @Assert\Range(min=0, max=5)
     */
    private $rating;

    /**
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank
     */
    private $body;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     */
    private $author;

    /**
     * @ORM\Column(type="datetime", length=255, nullable=false)
     *
     * @Assert\DateTime
     */
    private $publicationDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Book", inversedBy="reviews")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\NotNull
     */
    private $book;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(?\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }
}
