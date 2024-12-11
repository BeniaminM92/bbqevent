<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\EventTypeEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'required' => false,
                'help' => 'Trage den Eventnamen ein ',
                'attr' => ['class' => 'bar', 'style' => 'background-color: lightblue;' , 'placeholder' => 'Name'],])

            ->add('description', TextareaType::class)

            ->add('bookedseats', IntegerType::class)

            ->add('eventtype', EnumType::class, ['class' => EventTypeEnum::class,
                'expanded' => true,
//                'multiple' => true
            ])

            ->add('save', SubmitType::class)

            ->add('reset', ResetType::class);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
