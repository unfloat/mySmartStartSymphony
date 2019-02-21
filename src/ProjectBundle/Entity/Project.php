<?php

namespace ProjectBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\ProjectRepository")
 */
class Project
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
 * @ORM\Column(name="projectName", type="string", length=255)
 */
    public $projectName;


    /**
     * @var string
     *
     * @ORM\Column(name="projectCountry", type="string", length=255)
     */
    private $projectCountry;

    /**
     * @return string
     */
    public function getProjectCountry()
    {
        return $this->projectCountry;
    }

    /**
     * @param string $projectCountry
     */
    public function setProjectCountry($projectCountry)
    {
        $this->projectCountry = $projectCountry;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="projectDescription", type="string", length=255)
     */
    private $projectDescription;

    /**
     * @return string
     */
    public function getProjectDescription()
    {
        return $this->projectDescription;
    }

    /**
     * @param string $projectDescription
     */
    public function setProjectDescription($projectDescription)
    {
        $this->projectDescription = $projectDescription;
    }

    /**
     * @var float
     *
     * @ORM\Column(name="maxBudget", type="float")
     */
    private $maxBudget;


    /**
     * @var float
     *
     * @ORM\Column(name="minBudget", type="float")
     */
    private $minBudget;

    /**
     * @return float
     */
    public function getMinBudget()
    {
        return $this->minBudget;
    }

    /**
     * @param float $minBudget
     */
    public function setMinBudget($minBudget)
    {
        $this->minBudget = $minBudget;
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
     * Set projectName
     *
     * @param string $projectName
     *
     * @return Project
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }

    /**
     * Get projectName
     *
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Set maxBudget
     *
     * @param float $maxBudget
     *
     * @return Project
     */
    public function setMaxBudget($maxBudget)
    {
        $this->maxBudget = $maxBudget;

        return $this;
    }

    /**
     * Get maxBudget
     *
     * @return float
     */
    public function getMaxBudget()
    {
        return $this->maxBudget;
    }



}

