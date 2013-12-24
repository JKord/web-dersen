<?php
namespace Catalog\FilmsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use Catalog\FilmsBundle\Entity\Actors,
    Catalog\FilmsBundle\Entity\Categories,
    Catalog\FilmsBundle\Entity\Films;

class LoadFilmsData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this
            ->loadActors($manager)
            ->loadCategories($manager)
            ->loadFilms($manager);

        $manager->flush();
    }

    public function loadActors(ObjectManager $manager)
    {
        for($i = 0; $i < 10; $i++)
        {
            $actor = new Actors();
            $actor
                ->setName('Rak'.$i)
                ->setBirthday(new \DateTime());

            $manager->persist($actor);
        }

        return $this;
    }

    public function loadCategories(ObjectManager $manager)
    {
        for($i = 0; $i < 10; $i++)
        {
            $cat = new Categories();
            $cat->setName('Cat'.$i);

            $manager->persist($cat);
        }

        return $this;
    }

    public function loadFilms(ObjectManager $manager)
    {
        $manager->flush();
        $categoryRep = $manager->getRepository('CatalogFilmsBundle:Categories');
        $actorRep = $manager->getRepository('CatalogFilmsBundle:Actors');

        for($i = 0; $i < 10; $i++)
        {
            $film = new Films();
            $film
                ->setName('Film'.$i)
                ->addActor($actorRep->findAll()[$i])
                ->addCategory($categoryRep->findAll()[$i])
                ->setCreated(new \DateTime())
                ->setUpdated(new \DateTime());

            $manager->persist($film);
        }

        return $this;
    }
}