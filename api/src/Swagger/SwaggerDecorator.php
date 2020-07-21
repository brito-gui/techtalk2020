<?php

namespace App\Swagger;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class SwaggerDecorator implements NormalizerInterface
{
    private $decorated;

    public function __construct(NormalizerInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $docs = $this->decorated->normalize($object, $format, $context);
        $this->decorateUuid($docs);
        return $docs;
    }

    public function decorateUuid(&$docs) {
        $customIdParameters[] = [
            'name' => 'Uuid or Isbn',
            'in' => 'path',
            'required' => 'true',
            'type' => 'integer',
            'description' => "Internal Uuid or Book's Isbn",
        ];

        foreach ($docs['paths']['/books/{id}'] as &$method) {
            $method['parameters'] = $customIdParameters;
        }

        foreach ($docs['paths'] as $route => &$resource) {
            if (false !== strpos($route, '{id}')) {
                $docs['paths'][str_replace('{id}', '{uuid}', $route)] = $docs['paths'][$route];
                unset($docs['paths'][$route]);
            }
        }

        if (isset($docs['paths']['/books/{id}/reviews'])) {
            $docs['paths']['/books/{uuid}/reviews'] = $docs['paths']['/books/{id}/reviews'];
            foreach ($docs['paths']['/books/{uuid}/reviews'] as &$method) {
                $method['parameters'][0] = $customIdParameters[0];
            }
            unset($docs['paths']['/books/{id}/reviews']);
        }
    }

    public function supportsNormalization($data, $format = null)
    {
        return $this->decorated->supportsNormalization($data, $format);
    }
}
