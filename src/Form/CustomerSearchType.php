<?php

namespace App\Form;

use App\Entity\CustomerSearch;
use App\Entity\Nationality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('searchText', TextType::class,[
                'required' => false,
            ])
            ->add('nationality', EntityType::class, [
                'class' => Nationality::class,
                'placeholder' => 'Nationalité',
                'choice_label' => 'name',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CustomerSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
}
