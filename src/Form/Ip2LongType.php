<?php

namespace Wucdbm\SymfonyFormTypes\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Wucdbm\SymfonyFormTypes\DataTransformer\Ip2LongTransformer;

class Ip2LongType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->addModelTransformer(new Ip2LongTransformer());
    }

    public function getParent() {
        return TextType::class;
    }

}