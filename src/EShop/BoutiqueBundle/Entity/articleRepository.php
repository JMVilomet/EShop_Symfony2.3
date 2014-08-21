<?php

namespace EShop\BoutiqueBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * articleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class articleRepository extends EntityRepository
{
    public function findLastAdded(){
        try{
            $query = $this->createQueryBuilder("a")
                    ->where("a.enligne = 1")
                    ->orderBy("a.date_ajout", "desc")
                    ->setMaxResults(1)
                    ->getQuery();
            return $query->getSingleResult();
        }catch(NoResultException $e){
            return null;
        }
    }
    
    public function findLastPage($pagination){
        try {
            $query = $this->createQueryBuilder("a")
                    ->select("count(a.id)")
                    ->where("a.enligne = 1")
                    ->getQuery();
            $count = $query->getSingleScalarResult();
            
            if ($count){
                return ceil($count[0]/$pagination);
            }else
                return 1;
            
        } catch (NoResultException $e) {
            return 0;
        }
    }
}