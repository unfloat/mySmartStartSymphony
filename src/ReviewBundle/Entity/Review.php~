<?php

namespace ReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Review
 *
 * @ORM\Table(name="review")
 * @ORM\Entity(repositoryClass="ReviewBundle\Repository\ReviewRepository")
 */
class Review
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
     * @var bool
     *
     * @ORM\Column(name="onBudget", type="boolean")
     */
    private $onBudget;

    /**
     * @var bool
     *
     * @ORM\Column(name="onTime", type="boolean")
     */
    private $onTime;

    /**
     * @var int
     *
     * @ORM\Column(name="rating", type="integer")
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="ProjectBundle\Entity\Project")
     * @ORM\JoinColumn(name="projectId",referencedColumnName="id")
     */
    private $projectId;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Freelancer", inversedBy="reviewId")
     * @ORM\JoinColumn(name="freelancerReviewedId", referencedColumnName="id")
     */
    private $freelancerReviewedId;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Employer")
     * @ORM\JoinColumn(name="employerReviewerId",referencedColumnName="id")
     */
    private $employerReviewerId;


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
     * Set onBudget
     *
     * @param boolean $onBudget
     *
     * @return Review
     */
    public function setOnBudget($onBudget)
    {
        $this->onBudget = $onBudget;

        return $this;
    }

    /**
     * Get onBudget
     *
     * @return bool
     */
    public function getOnBudget()
    {
        return $this->onBudget;
    }

    /**
     * Set onTime
     *
     * @param boolean $onTime
     *
     * @return Review
     */
    public function setOnTime($onTime)
    {
        $this->onTime = $onTime;

        return $this;
    }

    /**
     * Get onTime
     *
     * @return bool
     */
    public function getOnTime()
    {
        return $this->onTime;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Review
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Review
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set projectId
     *
     * @param integer $projectId
     *
     * @return Review
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;

        return $this;
    }

    /**
     * Get projectId
     *
     * @return int
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return mixed
     */
    public function getFreelancerReviewedId()
    {
        return $this->freelancerReviewedId;
    }

    /**
     * @param mixed $freelancerReviewedId
     */
    public function setFreelancerReviewedId($freelancerReviewedId)
    {
        $this->freelancerReviewedId = $freelancerReviewedId;
    }

    /**
     * @return mixed
     */
    public function getEmployerReviewerId()
    {
        return $this->employerReviewerId;
    }

    /**
     * @param mixed $employerReviewerId
     */
    public function setEmployerReviewerId($employerReviewerId)
    {
        $this->employerReviewerId = $employerReviewerId;
    }


}
