<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('paragraph')
            ->add('content')
            ->add('createdAt')
            ->add('picture')
            ->add('slug')
            ->add('tag', EntityType::class, [
                'class' => Tag::class,
                'mapped' => false,
                'choice_label' => function (Tag $tag) {
                    return $tag->getName();
                }
            ])
            ->add('Category', EntityType::class, [
                'class' => Category::class,
                'mapped' => false,
                'choice_label' => function (Category $category) {
                    return $category->getName();
                }
            ])
             ;
        }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
