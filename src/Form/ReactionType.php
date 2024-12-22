<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Publication;
use App\Entity\Reaction;
use App\Entity\User;
use App\Enum\ReactionTypeEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => array_combine(
                    array_map(fn(ReactionTypeEnum $type) => $type->name, ReactionTypeEnum::cases()),
                    array_map(fn(ReactionTypeEnum $type) => $type, ReactionTypeEnum::cases()) // Directly use the enum objects as values
                ),
                'choice_label' => fn(ReactionTypeEnum $choice, $key, $value) => ucfirst($choice->name),
            ])
            ->add('reactor', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('publication', EntityType::class, [
                'class' => Publication::class,
                'choice_label' => 'id',
            ])
            ->add('comment', EntityType::class, [
                'class' => Comment::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reaction::class,
        ]);
    }
}
