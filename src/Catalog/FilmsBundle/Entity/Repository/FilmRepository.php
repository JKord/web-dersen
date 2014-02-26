<?php
namespace Catalog\FilmsBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class FilmRepository extends EntityRepository
{
    public function findAll()
    {
        $em = $this->getEntityManager();
        $query = $em
            ->createQueryBuilder()
            ->select('f')
            ->from('CatalogFilmsBundle:Films', 'f')
            ->leftJoin('f.translations','ft')
           // ->setFetchMode('f', 'articles', 'EAGER')
            ->getQuery()
            ->setHint(
                \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
            );

        return $query->execute();
    }

}