<?php

namespace App\DataFixtures;

use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ReviewFixtures extends Fixture implements DependentFixtureInterface
{
    const STATUS_PUBLISHED = 'PUBLISH';

    public function load(ObjectManager $manager)
    {
        $reviewsData = [
            [
                'rating' => 1,
                'body' => 'Amazing',
                'author' => 'Ringo Star',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-1'),
            ],
            [
                'rating' => 5,
                'body' => 'Mussum Ipsum, cacilds vidis litro abertis. Mé faiz elementum girarzis, nisi eros vermeio. Sapien in monti palavris qui num significa nadis i pareci latim. Casamentiss faiz malandris se pirulitá. Quem manda na minha terra sou euzis!',
                'author' => 'Batman',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-1'),
            ],
            [
                'rating' => 3,
                'body' => 'Mussum Ipsum, cacilds vidis litro abertis. Pra lá , depois divoltis porris, paradis. Posuere libero varius. Nullam a nisl ut ante blandit hendrerit. Aenean sit amet nisi. Admodum accumsan disputationi eu sit. Vide electram sadipscing et per. A ordem dos tratores não altera o pão duris.',
                'author' => 'Michael Douglas',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-1'),
            ],
            [
                'rating' => 5,
                'body' => 'Mussum Ipsum, cacilds vidis litro abertis. Pra lá , depois divoltis porris, paradis. Posuere libero varius. Nullam a nisl ut ante blandit hendrerit. Aenean sit amet nisi. Admodum accumsan disputationi eu sit. Vide electram sadipscing et per. A ordem dos tratores não altera o pão duris.',
                'author' => 'Ana Maria Braga',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-1'),
            ],
            [
                'rating' => 5,
                'body' => 'Mussum Ipsum, cacilds vidis litro abertis. Si u mundo tá muito paradis? Toma um mé que o mundo vai girarzis! Copo furadis é disculpa de bebadis, arcu quam euismod magna. Vehicula non. Ut sed ex eros. Vivamus sit amet nibh non tellus tristique interdum. Si num tem leite então bota uma pinga aí cumpadi!',
                'author' => 'Nicolas Cage',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-1'),
            ],
            [
                'rating' => 5,
                'body' => 'Mussum Ipsum, cacilds vidis litro abertis. Atirei o pau no gatis, per gatis num morreus. Todo mundo vê os porris que eu tomo, mas ninguém vê os tombis que eu levo! Detraxit consequat et quo num tendi nada. Per aumento de cachacis, eu reclamis.',
                'author' => 'Eddie Veder',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-1'),
            ],
            [
                'rating' => 5,
                'body' => 'Mussum Ipsum, cacilds vidis litro abertis. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis. Tá deprimidis, eu conheço uma cachacis que pode alegrar sua vidis. Per aumento de cachacis, eu reclamis. A ordem dos tratores não altera o pão duris.',
                'author' => 'Bruce Springsteen',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-1'),
            ],
            [
                'rating' => 5,
                'body' => 'Mussum Ipsum, cacilds vidis litro abertis. Quem manda na minha terra sou euzis! Si num tem leite então bota uma pinga aí cumpadi! Atirei o pau no gatis, per gatis num morreus. Cevadis im ampola pa arma uma pindureta.',
                'author' => 'Clint Eastwood',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-1'),
            ],
            [
                'rating' => 5,
                'body' => 'Mussum Ipsum, cacilds vidis litro abertis. Si u mundo tá muito paradis? Toma um mé que o mundo vai girarzis! Interagi no mé, cursus quis, vehicula ac nisi. Diuretics paradis num copo é motivis de denguis. Detraxit consequat et quo num tendi nada.

                Viva Forevis aptent taciti sociosqu ad litora torquent. Posuere libero varius. Nullam a nisl ut ante blandit hendrerit. Aenean sit amet nisi. Si num tem leite então bota uma pinga aí cumpadi! A ordem dos tratores não altera o pão duris.',
                'author' => 'Josh Brolin',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-1'),
            ],
            [
                'rating' => 5,
                'body' => 'Mussum Ipsum, cacilds vidis litro abertis. Não sou faixa preta cumpadi, sou preto inteiris, inteiris. Posuere libero varius. Nullam a nisl ut ante blandit hendrerit. Aenean sit amet nisi. Tá deprimidis, eu conheço uma cachacis que pode alegrar sua vidis. Si num tem leite então bota uma pinga aí cumpadi!

                A ordem dos tratores não altera o pão duris. Manduma pindureta quium dia nois paga. Nullam volutpat risus nec leo commodo, ut interdum diam laoreet. Sed non consequat odio. Quem num gosta di mim que vai caçá sua turmis!',
                'author' => 'Tony Stark',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-1'),
            ],
            [
                'rating' => 5,
                'body' => 'Mussum Ipsum, cacilds vidis litro abertis. Nec orci ornare consequat. Praesent lacinia ultrices consectetur. Sed non ipsum felis. Per aumento de cachacis, eu reclamis. Quem num gosta di mim que vai caçá sua turmis! Praesent vel viverra nisi. Mauris aliquet nunc non turpis scelerisque, eget.

                Admodum accumsan disputationi eu sit. Vide electram sadipscing et per. Pra lá , depois divoltis porris, paradis. Si num tem leite então bota uma pinga aí cumpadi! A ordem dos tratores não altera o pão duris.',
                'author' => 'Peter Parker',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-1'),
            ],
            [
                'rating' => 5,
                'body' => 'Not so great',
                'author' => 'John Doe',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-2'),
            ],
            [
                'rating' => 1,
                'body' => 'Awesome!',
                'author' => 'Mary Poppins',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-2'),
            ],
            [
                'rating' => 2,
                'body' => '',
                'author' => 'David Beckham',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-2'),
            ],
            [
                'rating' => 3,
                'body' => '',
                'author' => 'Coronel Mostarda',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-2'),
            ],
            [
                'rating' => 3,
                'body' => '',
                'author' => 'Steve Rogers',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-2'),
            ],
            [
                'rating' => 3,
                'body' => 'Mussum Ipsum, cacilds vidis litro abertis. Nec orci ornare consequat. Praesent lacinia ultrices consectetur. Sed non ipsum felis. Per aumento de cachacis, eu reclamis. Quem num gosta di mim que vai caçá sua turmis! Praesent vel viverra nisi. Mauris aliquet nunc non turpis scelerisque, eget.

                Admodum accumsan disputationi eu sit. Vide electram sadipscing et per. Pra lá , depois divoltis porris, paradis. Si num tem leite então bota uma pinga aí cumpadi! A ordem dos tratores não altera o pão duris.',
                'author' => 'John Lenon',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-2'),
            ],
            [
                'rating' => 3,
                'body' => '',
                'author' => 'Airton Senna',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-2'),
            ],
            [
                'rating' => 3,
                'body' => '',
                'author' => 'Lee Van Cleef',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-2'),
            ],
            [
                'rating' => 3,
                'body' => '',
                'author' => 'Coronel Mostarda',
                'publicationDate' => new \DateTime('now'),
                'book' => $this->getReference('book-2'),
            ],
        ];

        foreach ($reviewsData as $reviewData) {
            $review = new Review();
            $review->setRating($reviewData['rating']);
            $review->setBody($reviewData['body']);
            $review->setAuthor($reviewData['author']);
            $review->setPublicationDate($reviewData['publicationDate']);
            $review->setBook($reviewData['book']);
            $manager->persist($review);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            BookFixtures::class,
        );
    }
}
