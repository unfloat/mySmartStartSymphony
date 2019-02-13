<?php

namespace ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Skill
 *
 * @ORM\Table(name="skill")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\SkillRepository")
 */
class Skill
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
     * @ORM\Column(name="skillName", type="string", length=255)
     */
    private $skillName;


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
     * Set skillName
     *
     * @param string $skillName
     *
     * @return Skill
     */
    public function setSkillName($skillName)
    {
        $this->skillName = $skillName;

        return $this;
    }

    /**
     * Get skillName
     *
     * @return string
     */
    public function getSkillName()
    {
        return $this->skillName;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="projet", type="string", length=255)
     */
    /**
     * @ORM\ManyToOne(targetEntity="ProjectBundle\Entity\Project")
     * @ORM\JoinColumn(name="project_id",referencedColumnName="id")
     *
     */
    private $project;

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }
}

