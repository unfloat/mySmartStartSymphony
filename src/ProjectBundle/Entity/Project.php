<?php

namespace ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mgilet\NotificationBundle\Annotation\Notifiable;
use Mgilet\NotificationBundle\NotifiableInterface;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\ProjectRepository")
 * @Notifiable(name="project")

 */
class Project implements NotifiableInterface
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
     * @ORM\Column(name="projectDescription", type="text", length=255)
     */
    private $projectDescription;

    /**
     * @ORM\OneToMany(targetEntity="BidBundle\Entity\Bid", mappedBy="project")
     */
    private $projectBids;

    /**
     * @ORM\OneToMany(targetEntity="BookmarkBundle\Entity\Bookmark", mappedBy="project")
     */
    private $projectBookmarks;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Employer")
     * @ORM\JoinColumn(name="employer_id", referencedColumnName="id")
     */
    private $employer;




    /**
     * Many features projects have one  category product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="OfferBundle\Entity\Category", inversedBy="projects")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $projectCategory;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="projectStartDay", type="date")
     */
    private $projectStartDay;

    /**
     * @return \DateTime
     */
    public function getProjectStartDay()
    {
        return $this->projectStartDay;
    }

    /**
     * @param \DateTime $projectStartDay
     */
    public function setProjectStartDay($projectStartDay)
    {
        $this->projectStartDay = $projectStartDay;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Many Users P have Many GroupsS .
     * @ORM\ManyToMany(targetEntity="OfferBundle\Entity\Skills")
     * @ORM\JoinTable(name="projects_skills",
     *      joinColumns={@ORM\JoinColumn(name="project_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="skill_id", referencedColumnName="id")}
     *      )
     */
    private $skills;

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return $this->skills;
    }



    /**
     * @return mixed
     */
    public function getProjectCategory()
    {
        return $this->projectCategory;
    }

    /**
     * @param mixed $projectCategory
     */
    public function setProjectCategory($projectCategory)
    {
        $this->projectCategory = $projectCategory;
    }




    /**
     * @var string
     *
     * @ORM\Column(name="projectEndDay", type="date")
     */

    private $projectEndDay;

    /**
     * @return string
     */
    public function getProjectEndDay()
    {
        return $this->projectEndDay;
    }

    /**
     * @param string $projectEndDay
     */
    public function setProjectEndDay($projectEndDay)
    {
        $this->projectEndDay = $projectEndDay;
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


    /**
     * Set employer
     *
     * @param \UserBundle\Entity\Employer $employer
     *
     * @return Project
     */
    public function setEmployer(\UserBundle\Entity\Employer $employer = null)
    {
        $this->employer = $employer;

        return $this;
    }

    /**
     * Get employer
     *
     * @return \UserBundle\Entity\Employer
     */
    public function getEmployer()
    {
        return $this->employer;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projectBids = new \Doctrine\Common\Collections\ArrayCollection();
        $this->skills = new \Doctrine\Common\Collections\ArrayCollection();


    }

    /**
     * Add projectBid
     *
     * @param \BidBundle\Entity\Bid $projectBid
     *
     * @return Project
     */
    public function addProjectBid(\BidBundle\Entity\Bid $projectBid)
    {
        $this->projectBids[] = $projectBid;

        return $this;
    }

    /**
     * Remove projectBid
     *
     * @param \BidBundle\Entity\Bid $projectBid
     */
    public function removeProjectBid(\BidBundle\Entity\Bid $projectBid)
    {
        $this->projectBids->removeElement($projectBid);
    }

    /**
     * Get projectBids
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjectBids()
    {
        return $this->projectBids;
    }

    /**
     * Add projectBookmark
     *
     * @param \BookmarkBundle\Entity\Bookmark $projectBookmark
     *
     * @return Project
     */
    public function addProjectBookmark(\BookmarkBundle\Entity\Bookmark $projectBookmark)
    {
        $this->projectBookmarks[] = $projectBookmark;

        return $this;
    }

    /**
     * Remove projectBookmark
     *
     * @param \BookmarkBundle\Entity\Bookmark $projectBookmark
     */
    public function removeProjectBookmark(\BookmarkBundle\Entity\Bookmark $projectBookmark)
    {
        $this->projectBookmarks->removeElement($projectBookmark);
    }

    /**
     * Get projectBookmarks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjectBookmarks()
    {
        return $this->projectBookmarks;
    }






}
