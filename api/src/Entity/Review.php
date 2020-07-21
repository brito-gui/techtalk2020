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
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *      itemOperations={
 *          "get"={
 *              "method"="GET",
 *              "path"="/reviews/{id}",
 *          },
 *          "get_book_reviews_subresource"={
 *              "method"="GET",
 *              "path"="/books/{uuid}/all-reviews",
 *              "controller"=\App\Controller\GetBooksReviewsController::class,
 *              "normalization_context"={"groups"={"review:read"}},
 *              "read"=false,
 *          },
 *          "patch",
 *          "put",
 *          "delete",
 *      },
 *      attributes={
 *          "normalization_context"={
 *               "datetime_format"="Y-m-d H:i:s",
 *               "groups"={"review:read", "default"}
 *          },
 *          "denormalization_context"={
 *               "datetime_format"="Y-m-d H:i:s",
 *               "groups"={"review:write", "default"}
 *          },
 *      },
 *      denormalizationContext={"groups"={"review:write", "default"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 * @ORM\HasLifecycleCallbacks()
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
     * @var Uuid
     *
     * @ORM\Id
     * @ORM\Column(type="uuid")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     *
     * @Groups({"review:read", "default"})
     */
    protected $id;

    /**
     * @ORM\Column(type="smallint")
     *
     * @Assert\Range(min=0, max=5)
     *
     * @Groups({"review:read", "review:write"})
     */
    private $rating;

    /**
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank
     *
     * @Groups({"review:read", "review:write"})
     */
    private $body;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     *
     * @Groups({"review:read", "review:write"})
     */
    private $author;

    /**
     * @ORM\Column(type="datetime", length=255, nullable=false)
     *
     * @Assert\Type("\DateTimeInterface")
     *
     * @Groups({"review:read"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Book", inversedBy="reviews")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\NotNull
     *
     * @Groups({"review:read", "review:write"})
     */
    private $book;

    public function getId(): ?Uuid
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist()
     */
    public function generateCreatedAt(): self
    {
        $this->createdAt = new \DateTime('now');

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
