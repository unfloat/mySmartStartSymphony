<?php

namespace ReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReviewEmp
 *
 * @ORM\Table(name="review_emp")
 * @ORM\Entity(repositoryClass="ReviewBundle\Repository\ReviewEmpRepository")
 */
class ReviewEmp
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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Employer", inversedBy="reviewId")
     * @ORM\JoinColumn(name="employerReviewedId", referencedColumnName="id")
     */
    private $employerReviewedId;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Freelancer")
     * @ORM\JoinColumn(name="freelancerReviewerId",referencedColumnName="id")
     */
    private $freelancerReviewerId;


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
     * Set rating
     *
     * @param integer $rating
     *
     * @return ReviewEmp
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
     * @return ReviewEmp
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
     * @param string $projectId
     *
     * @return ReviewEmp
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;

        return $this;
    }

    /**
     * Get projectId
     *
     * @return string
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * Set employerReviewedId
     *
     * @param string $employerReviewedId
     *
     * @return ReviewEmp
     */
    public function setEmployerReviewedId($employerReviewedId)
    {
        $this->employerReviewedId = $employerReviewedId;

        return $this;
    }

    /**
     * Get employerReviewedId
     *
     * @return string
     */
    public function getEmployerReviewedId()
    {
        return $this->employerReviewedId;
    }

    /**
     * Set freelancerReviewerId
     *
     * @param string $freelancerReviewerId
     *
     * @return ReviewEmp
     */
    public function setFreelancerReviewerId($freelancerReviewerId)
    {
        $this->freelancerReviewerId = $freelancerReviewerId;

        return $this;
    }

    /**
     * Get freelancerReviewerId
     *
     * @return string
     */
    public function getFreelancerReviewerId()
    {
        return $this->freelancerReviewerId;
    }
}
