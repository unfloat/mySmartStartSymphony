<?php

namespace ProjectBundle\Entity;

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
    private $projectName;

    /**
     * @var string
     *
     * @ORM\Column(name="projectCategory", type="string", length=255)
     */
    private $projectCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="projectLocation", type="string", length=255)
     */
    private $projectLocation;

    /**
     * @var float
     *
     * @ORM\Column(name="minBudget", type="float")
     */
    private $minBudget;

    /**
     * @var float
     *
     * @ORM\Column(name="maxBudget", type="float")
     */
    private $maxBudget;

    /**
     * @var string
     *
     * @ORM\Column(name="projectSkill", type="string", length=255)
     */
    private $projectSkill;

    /**
     * @var string
     *
     * @ORM\Column(name="projectDescription", type="string", length=255)
     */
    private $projectDescription;


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
     * Set projectCategory
     *
     * @param string $projectCategory
     *
     * @return Project
     */
    public function setProjectCategory($projectCategory)
    {
        $this->projectCategory = $projectCategory;

        return $this;
    }

    /**
     * Get projectCategory
     *
     * @return string
     */
    public function getProjectCategory()
    {
        return $this->projectCategory;
    }

    /**
     * Set projectLocation
     *
     * @param string $projectLocation
     *
     * @return Project
     */
    public function setProjectLocation($projectLocation)
    {
        $this->projectLocation = $projectLocation;

        return $this;
    }

    /**
     * Get projectLocation
     *
     * @return string
     */
    public function getProjectLocation()
    {
        return $this->projectLocation;
    }

    /**
     * Set minBudget
     *
     * @param float $minBudget
     *
     * @return Project
     */
    public function setMinBudget($minBudget)
    {
        $this->minBudget = $minBudget;

        return $this;
    }

    /**
     * Get minBudget
     *
     * @return float
     */
    public function getMinBudget()
    {
        return $this->minBudget;
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

    /**
     * Set projectSkill
     *
     * @param string $projectSkill
     *
     * @return Project
     */
    public function setProjectSkill($projectSkill)
    {
        $this->projectSkill = $projectSkill;

        return $this;
    }

    /**
     * Get projectSkill
     *
     * @return string
     */
    public function getProjectSkill()
    {
        return $this->projectSkill;
    }

    /**
     * Set projectDescription
     *
     * @param string $projectDescription
     *
     * @return Project
     */
    public function setProjectDescription($projectDescription)
    {
        $this->projectDescription = $projectDescription;

        return $this;
    }

    /**
     * Get projectDescription
     *
     * @return string
     */
    public function getProjectDescription()
    {
        return $this->projectDescription;
    }
}

