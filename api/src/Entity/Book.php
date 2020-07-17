<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *      attributes={
 *          "normalization_context"={
 *               "datetime_format"="Y-m-d",
 *          },
 *          "denormalization_context"={
 *               "datetime_format"="Y-m-d",
 *          },
 *      }
 * )
 *
 * @ApiFilter(DateFilter::class, properties={"publicationDate"})
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "isbn": "exact", "description": "partial", "author": "partial", "reviews.rating": "exact"})
 * @ApiFilter(RangeFilter::class, properties={"pageCount"})
 * @ApiFilter(ExistsFilter::class, properties={"isbn", "publicationDate", "reviews"})
 * @ApiFilter(OrderFilter::class,
 *      properties={
 *          "publicationDate": { "nulls_comparison": OrderFilter::NULLS_SMALLEST, "default_direction": "DESC" },
 *          "pageCount": { "default_direction": "DESC" }
 *      }
 * )
 * @ApiFilter(BooleanFilter::class)
 * @ApiFilter(PropertyFilter::class)
 *
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Isbn()
     */
    private $isbn;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Assert\Type("integer")
     */
    private $pageCount;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Assert\Type("\DateTimeInterface")
     */
    private $publicationDate;

    /**
     * @var Collection|Review[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="book")
     *
     * @ApiSubresource
     */
    private $reviews;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     *
     * @Assert\Type("boolean")
     */
    private $published;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(?string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection|Review[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setBook($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->contains($review)) {
            $this->reviews->removeElement($review);
            // set the owning side to null (unless already changed)
            if ($review->getBook() === $this) {
                $review->setBook(null);
            }
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPageCount(): ?int
    {
        return $this->pageCount;
    }

    public function setPageCount(?int $pageCount): self
    {
        $this->pageCount = $pageCount;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }
}
