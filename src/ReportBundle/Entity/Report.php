<?php

namespace ReportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Report
 *
 * @ORM\Table(name="report")
 * @ORM\Entity(repositoryClass="ReportBundle\Repository\ReportRepository")
 */
class Report
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
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Employer")
     * @ORM\JoinColumn(name="employerReporterId",referencedColumnName="id")
     */
    private $employerReporterId;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Freelancer")
     * @ORM\JoinColumn(name="freelancerReportedId", referencedColumnName="id")
     */
    private $freelancerReportedId;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;


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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Report
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set employerReporterId
     *
     * @param string $employerReporterId
     *
     * @return Report
     */
    public function setEmployerReporterId($employerReporterId)
    {
        $this->employerReporterId = $employerReporterId;

        return $this;
    }

    /**
     * Get employerReporterId
     *
     * @return string
     */
    public function getEmployerReporterId()
    {
        return $this->employerReporterId;
    }

    /**
     * Set freelancerReportedId
     *
     * @param string $freelancerReportedId
     *
     * @return Report
     */
    public function setFreelancerReportedId($freelancerReportedId)
    {
        $this->freelancerReportedId = $freelancerReportedId;

        return $this;
    }

    /**
     * Get freelancerReportedId
     *
     * @return string
     */
    public function getFreelancerReportedId()
    {
        return $this->freelancerReportedId;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Report
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
}
