<?php

namespace App\Model;

use App\Entity\Book;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\ORM\EntityManagerInterface;

class BookModel {

    /**
     * @param EntityManagerInterface $em
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getByIdOrIsbn($id) {
        try {
            return $this->em->getRepository(Book::class)->find($id);
        } catch (ConversionException $e) {
            return $this->em->getRepository(Book::class)->findOneBy(['isbn' => $id]);
        }
    }

}