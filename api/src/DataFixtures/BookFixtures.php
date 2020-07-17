<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    const STATUS_PUBLISHED = 'PUBLISH';

    public function load(ObjectManager $manager)
    {
        $booksData = json_decode(file_get_contents(__DIR__.'/json/books.json'));
        foreach ($booksData as $key => $bookData) {
            $book = new Book();
            $book->setTitle($bookData->title);
            $book->setIsbn($bookData->isbn ?? null);
            $book->setPageCount($bookData->pageCount ?? 0);
            $book->setPublicationDate(isset($bookData->publishedDate) ? new \DateTime($bookData->publishedDate->date) : null);
            $book->setDescription($bookData->longDescription ?? '');
            $book->setAuthor(implode(', ', $bookData->authors));
            $book->setPublished((bool) ($bookData->status === self::STATUS_PUBLISHED));
            $this->addReference(sprintf('book-%s', $key+1), $book);
            $manager->persist($book);
        }

        $manager->flush();
    }    
}
