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
     * @ORM\Column(name="skills", type="string", length=255)
     */
    /**
     * @ORM\ManyToOne(targetEntity="ProjectBundle\Entity\Skill")
     * @ORM\JoinColumn(name="skill_id",referencedColumnName="id")
     *
     */
    private $skills;


    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    /**
     * @ORM\OneToOne(targetEntity="ProjectBundle\Entity\Category")
     * @ORM\JoinColumn(name="category_id",referencedColumnName="id")
     *
     */
    private $category;


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
     * Set skills
     *
     * @param string $skills
     *
     * @return Project
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;

        return $this;
    }

    /**
     * Get skills
     *
     * @return string
     */
    public function getSkills()
    {
        return $this->skills;
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


}

