<?php

namespace App\Controller;

use App\Model\BookModel;

class GetBooksReviewsController
{
    /**
     * @var BookModel
     */
    private $bookModel;

    public function __construct(BookModel $bookModel)
    {
        $this->bookModel = $bookModel;
    }

    public function __invoke($uuid)
    {
        $book = $this->bookModel->getByIdOrIsbn($uuid);
        if (is_null($book)) {
            return [];
        }
        return $book->getReviews();
    }
}
