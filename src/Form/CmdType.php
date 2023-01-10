<?php

namespace App\Form;

use App\Entity\Cmd;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CmdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('c_date')
            ->add('c_totalPrice')
            ->add('payee')
            ->add('retrait')
            ->add('Panier')
            ->add('User')
            ->add('addressFact')
            ->add('addressLiv')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cmd::class,
        ]);
    }
}
