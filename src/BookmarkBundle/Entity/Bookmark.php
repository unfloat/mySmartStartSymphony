<?php

namespace BookmarkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bookmark
 *
 * @ORM\Table(name="bookmark")
 * @ORM\Entity(repositoryClass="BookmarkBundle\Repository\BookmarkRepository")
 */
class Bookmark
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
     * @ORM\Column(name="dateAdded", type="date", nullable=true)
     */
    private $dateAdded;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Freelancer", inversedBy="bookmarks")
     * @ORM\JoinColumn(name="freelancer_id", referencedColumnName="id")
     */
    private $freelancer;

    /**
     * @ORM\ManyToOne(targetEntity="ProjectBundle\Entity\Project", inversedBy="projectBookmarks")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;














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
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return Bookmark
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add project
     *
     * @param \ProjectBundle\Entity\Project $project
     *
     * @return Bookmark
     */
    public function addProject(\ProjectBundle\Entity\Project $project)
    {
        $this->projects[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \ProjectBundle\Entity\Project $project
     */
    public function removeProject(\ProjectBundle\Entity\Project $project)
    {
        $this->projects->removeElement($project);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Bookmark
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }


    /**
     * Set freelancer
     *
     * @param \UserBundle\Entity\Freelancer $freelancer
     *
     * @return Bookmark
     */
    public function setFreelancer(\UserBundle\Entity\Freelancer $freelancer = null)
    {
        $this->freelancer = $freelancer;

        return $this;
    }

    /**
     * Get freelancer
     *
     * @return \UserBundle\Entity\Freelancer
     */
    public function getFreelancer()
    {
        return $this->freelancer;
    }

    /**
     * Set project
     *
     * @param \ProjectBundle\Entity\Project $project
     *
     * @return Bookmark
     */
    public function setProject(\ProjectBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \ProjectBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
