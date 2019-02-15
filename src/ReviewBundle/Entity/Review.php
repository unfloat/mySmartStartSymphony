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
     * @var int
     *
     * @ORM\Column(name="projectId", type="integer")
     */
    private $projectId;

    /**
     * @var int
     *
     * @ORM\Column(name="freelancerId", type="integer")
     */
    private $freelancerId;


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
     * Set freelancerId
     *
     * @param integer $freelancerId
     *
     * @return Review
     */
    public function setFreelancerId($freelancerId)
    {
        $this->freelancerId = $freelancerId;

        return $this;
    }

    /**
     * Get freelancerId
     *
     * @return int
     */
    public function getFreelancerId()
    {
        return $this->freelancerId;
    }
}

