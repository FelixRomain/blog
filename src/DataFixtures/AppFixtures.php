<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('FR-fr');

        for($i = 1; $i <= 10; $i++ ) {
            $article = new Article();

            $title = $faker->sentence();
            $paragraph = $faker->paragraph(3);
            $picture = $faker->imageUrl(250, 150);
            $created = $faker->dateTime();
            // $content = '<p>' . join('</p><p>', $faker->paragraphs(5) . '</p>');

            $article->setTitle($title)
                ->setParagraph($paragraph)
                ->setContent($paragraph)
                ->setPicture($picture)
                ->setSlug("titre-de-l-article-n-$i")
                ->setCreatedAt($created);
            
            $manager->persist($article);
        }

        for($j = 1; $j <= 10; $j++ ) {
            $category = new Category();

            $name = $faker->sentence(1);
            $color = $faker->hexcolor();

            $category->setName($name)
                ->setColor($color);
            
            $manager->persist($category);
        }

        for($u = 1; $u <= 1; $u++ ) {
            $user = new User();

            $password = $this->encoder->encodePassword($user, 'RomainChameleon$990');


            $user->setEmail("felix.romain@hotmail.fr")
                ->setPassword($password);
            
            $manager->persist($user);
        }

        $manager->flush();
    }
}
