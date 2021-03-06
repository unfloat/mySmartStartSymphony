<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mgilet\NotificationBundle\Annotation\Notifiable;
use Mgilet\NotificationBundle\NotifiableInterface;

/**
 * Employer
 * @ORM\Entity(repositoryClass="UserBundle\Repository\EmployerRepository")
 * @Notifiable(name="employer")
 */
class Employer extends User implements NotifiableInterface
{
    public function __construct()
    {
        parent::__construct();

    }

    function loadFromParentObj( $parentObj )
    {
        $objValues = get_object_vars($parentObj); // return array of object values
        foreach($objValues AS $key=>$value)
        {
            $this->$key = $value;
        }
    }

    /**
     * @var string
     *
     * @ORM\Column(name="companyName", type="string", length=255)
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="about", type="string", length=255)
     */
    private $about;



    /**
     * @ORM\OneToMany(targetEntity="JobBundle\Entity\Job", mappedBy="employer")
     */
    private $jobs;

    /**
     * @ORM\OneToMany(targetEntity="OfferBundle\Entity\Offer", mappedBy="employer")
     */
    private $offers;



    /**
     * @ORM\OneToMany(targetEntity="ReviewBundle\Entity\ReviewEmp", mappedBy="employerReviewedId")
     */
    private $reviewId;

    /**
     * @return mixed
     */
    public function getReviewId()
    {
        return $this->reviewId;
    }

    /**
     * @param mixed $reviewId
     */
    public function setReviewId($reviewId)
    {
        $this->reviewId = $reviewId;
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
     * Set companyName
     *
     * @param string $companyName
     *
     * @return Employer
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set about
     *
     * @param string $about
     *
     * @return Employer
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Add job
     *
     * @param \JobBundle\Entity\Job $job
     *
     * @return Employer
     */
    public function addJob(\JobBundle\Entity\Job $job)
    {
        $this->jobs[] = $job;

        return $this;
    }

    /**
     * Remove job
     *
     * @param \JobBundle\Entity\Job $job
     */
    public function removeJob(\JobBundle\Entity\Job $job)
    {
        $this->jobs->removeElement($job);
    }

    /**
     * Get jobs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * Add reviewId
     *
     * @param \ReviewBundle\Entity\ReviewEmp $reviewId
     *
     * @return Employer
     */
    public function addReviewId(\ReviewBundle\Entity\ReviewEmp $reviewId)
    {
        $this->reviewId[] = $reviewId;

        return $this;
    }

    /**
     * Remove reviewId
     *
     * @param \ReviewBundle\Entity\ReviewEmp $reviewId
     */
    public function removeReviewId(\ReviewBundle\Entity\ReviewEmp $reviewId)
    {
        $this->reviewId->removeElement($reviewId);
    }
}
