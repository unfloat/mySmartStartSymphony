<?php

namespace OfferBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Offer
 *
 * @ORM\Table(name="offer")
 * @ORM\Entity(repositoryClass="OfferBundle\Repository\OfferRepository")
 */
class Offer
{
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
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */

    private $type;

    /**
     * @var date $dateCreation
     * @ORM\Column(name="date_creation", type="datetime", nullable=true)
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */



    private $location;



    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="Offer")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;





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
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }




    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */

    private $status="En Attente";

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    /**
     * @var int
     *
     * @ORM\Column(name="priceMin", type="integer")
     */
    private $priceMin;


    /**
     * @var int
     *
     * @ORM\Column(name="priceMax", type="integer")
     */
    private $priceMax;





    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;



    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Freelancer", inversedBy="Offer")
     * @ORM\JoinColumn(name="freelancer_id",referencedColumnName="id")
     */
    private $freelancer;


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Employer", inversedBy="Offer")
     * @ORM\JoinColumn(name="Employer_id",referencedColumnName="id")
     */
    private $employer;

    /**
     * @return mixed
     */
    public function getEmployer()
    {
        return $this->employer;
    }

    /**
     * @param mixed $employer
     */
    public function setEmployer($employer)
    {
        $this->employer = $employer;
    }





    /**
     * @return mixed
     */
    public function getFreelancer()
    {
        return $this->freelancer;
    }

    /**
     * @param mixed $freelancer
     */
    public function setFreelancer($freelancer)
    {
        $this->freelancer = $freelancer;
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
     * @return Offer
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

    /**
     * Set priceMin
     *
     * @param integer $priceMin
     *
     * @return Offer
     */
    public function setPriceMin($priceMin)
    {
        $this->priceMin = $priceMin;

        return $this;
    }

    /**
     * Get priceMin
     *
     * @return int
     */
    public function getPriceMin()
    {
        return $this->priceMin;
    }

    /**
     * Set priceMax
     *
     * @param string $priceMax
     *
     * @return Offer
     */
    public function setPriceMax($priceMax)
    {
        $this->priceMax = $priceMax;

        return $this;
    }

    /**
     * Get priceMax
     *
     * @return string
     */
    public function getPriceMax()
    {
        return $this->priceMax;
    }

    public function __construct()
    {
        $this->dateCreation = new \DateTime();
    }


}
