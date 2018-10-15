<?php

namespace Wucdbm\SymfonyFormTypes\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class EntityToIdTransformer implements DataTransformerInterface {

    /** @var ObjectManager */
    protected $objectManager;

    /** @var string */
    protected $class;

    public function __construct(ObjectManager $objectManager, string $class) {
        $this->objectManager = $objectManager;
        $this->class = $class;
    }

    public function transform($entity) {
        if (null === $entity) {
            return null;
        }

        return $entity->getId();
    }

    public function reverseTransform($id) {
        if (!$id) {
            return null;
        }

        $entity = $this->objectManager
            ->getRepository($this->class)
            ->find($id);

        if (null === $entity) {
            throw new TransformationFailedException();
        }

        return $entity;
    }
}