<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class BookNormalizer implements NormalizerInterface
{
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function normalize($object, $format = null, array $context = array()): array
    {
        $data = $this->normalizer->normalize($object, $format, $context);
        if (isset($data['author'])) {
            $data['authors'] = explode(', ', $data['author']);
        }

        return $data;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof \App\Entity\Book;
    }
}
