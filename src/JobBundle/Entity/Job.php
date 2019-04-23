<?php

namespace JobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Job
 *
 * @ORM\Table(name="job")
 * @ORM\Entity(repositoryClass="JobBundle\Repository\JobRepository")

 */
class Job
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", columnDefinition="enum('FullTime', 'PartTime', 'Internship', 'Temporary')")
     */
    private $type;


    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @var float
     *
     * @ORM\Column(name="minSalary", type="float")
     */
    private $minSalary;

    /**
     * @var float
     *
     * @ORM\Column(name="maxSalary", type="float")
     */
    private $maxSalary;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="string", length=255)
     */
    private $tags;



    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Employer", inversedBy="job")
     * @ORM\JoinColumn(name="employer_id", referencedColumnName="id")
     */
    private $employer;


    /**
     * @ORM\ManyToOne(targetEntity="OfferBundle\Entity\Category", inversedBy="job")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;







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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Job
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

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
     * Set location
     *
     * @param string $location
     *
     * @return Job
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set minSalary
     *
     * @param float $minSalary
     *
     * @return Job
     */
    public function setMinSalary($minSalary)
    {
        $this->minSalary = $minSalary;

        return $this;
    }

    /**
     * Get minSalary
     *
     * @return float
     */
    public function getMinSalary()
    {
        return $this->minSalary;
    }

    /**
     * Set maxSalary
     *
     * @param float $maxSalary
     *
     * @return Job
     */
    public function setMaxSalary($maxSalary)
    {
        $this->maxSalary = $maxSalary;

        return $this;
    }

    /**
     * Get maxSalary
     *
     * @return float
     */
    public function getMaxSalary()
    {
        return $this->maxSalary;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Job
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set tags
     *
     * @param string $tags
     *
     * @return Job
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }
}

