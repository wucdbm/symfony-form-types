<?php

namespace Wucdbm\SymfonyFormTypes\Form\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Wucdbm\SymfonyFormTypes\DataTransformer\EntityToIdTransformer;

class EntityHiddenType extends AbstractType {

    /** @var ObjectManager */
    private $om;

    /** @param ObjectManager $om */
    public function __construct(ObjectManager $om) {
        $this->om = $om;
    }

    /**
     * Add the data transformer to the field setting the entity repository
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        /** @var DataTransformerInterface $entityTransformer */
        $entityTransformer = new $options['transformer']($this->om, $options['class']);
        $builder->addModelTransformer($entityTransformer);
    }

    /**
     * Require the entity repository option to be set on the field
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'transformer' => EntityToIdTransformer::class
        ]);
        $resolver->setRequired([
            'class'
        ])->setDefaults([
            'invalid_message' => 'The entity does not exist.',
        ]);
    }

    /**
     * Set the parent form type to hidden
     *
     * @return string
     */
    public function getParent() {
        return HiddenType::class;
    }
}