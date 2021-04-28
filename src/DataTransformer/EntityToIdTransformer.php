<?php

namespace Wucdbm\SymfonyFormTypes\DataTransformer;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class EntityToIdTransformer implements DataTransformerInterface {

    /** @var EntityManagerInterface */
    protected $em;

    /** @var string */
    protected $class;

    public function __construct(EntityManagerInterface $em, string $class) {
        $this->em = $em;
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

        $entity = $this->em
            ->getRepository($this->class)
            ->find($id);

        if (null === $entity) {
            throw new TransformationFailedException();
        }

        return $entity;
    }
}