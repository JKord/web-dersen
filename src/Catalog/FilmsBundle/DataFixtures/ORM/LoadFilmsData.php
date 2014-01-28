<?php
namespace Catalog\FilmsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface,
    Doctrine\Common\Persistence\ObjectManager,
    Symfony\Component\DependencyInjection\ContainerAwareInterface,
    Symfony\Component\DependencyInjection\ContainerInterface;

use Catalog\FilmsBundle\Entity\Actors,
    Catalog\FilmsBundle\Entity\Categories,
    Catalog\FilmsBundle\Entity\Films,
    Catalog\FilmsBundle\Entity\User;

class LoadFilmsData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $this
            ->loadUser($manager)
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

    public function loadUser(ObjectManager $manager)
    {
        $um = $this->container->get('fos_user.user_manager');

        $user = $um->createUser();
        $user
            ->setUsername('admin')
            ->setPlainPassword('adminpass')
            ->setEmail('admin@a.a')
            ->setEnabled(true)
            ->setRoles(array('ROLE_ADMIN'));

        $manager->persist($user);

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