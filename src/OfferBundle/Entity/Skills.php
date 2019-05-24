<?php

namespace OfferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Skills
 *
 * @ORM\Table(name="skills")
 * @ORM\Entity(repositoryClass="OfferBundle\Repository\SkillsRepository")
 */
class Skills
{

    public function __construct() {
        $this->offers = new \Doctrine\Common\Collections\ArrayCollection();

    }
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="skills")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;


    private $offers;

    /**
     * @return mixed
     */
    public function getOffers()
    {
        return $this->offers;
    }

    /**
     * @param mixed $offers
     */
    public function setOffers($offers)
    {
        $this->offers = $offers;
    }



    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Skills
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


}
