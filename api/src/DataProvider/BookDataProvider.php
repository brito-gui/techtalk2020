<?php
// api/src/DataProvider/BlogPostItemDataProvider.php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Book;
use App\Model\BookModel;

final class BookDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var BookModel
     */
    private $bookModel;

    public function __construct(BookModel $bookModel)
    {
        $this->bookModel = $bookModel;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Book::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Book
    {
        return $this->bookModel->getByIdOrIsbn($id);
    }
}
