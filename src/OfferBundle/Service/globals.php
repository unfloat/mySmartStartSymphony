<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 28/02/2019
 * Time: 17:47
 */

namespace OfferBundle\Service;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use OfferBundle\Entity\Offer;


class globals
{


    public function renderOffer(){

     //   $em = $this->container->get('doctrine.orm.entity_manager');
        $offer= $this->em->getRepository(Offer::class)->findAll();
       return $offer[0];
    }

    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }
}