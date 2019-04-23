<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mgilet\NotificationBundle\Annotation\Notifiable;
use Mgilet\NotificationBundle\NotifiableInterface;

/**
 * Freelancer
 * @ORM\Entity(repositoryClass="UserBundle\Repository\FreelancerRepository")
 * @Notifiable(name="freelancer")
 */
class Freelancer extends User implements NotifiableInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    function loadFromParentObj( $parentObj )
    {
        $objValues = get_object_vars($parentObj);
        foreach($objValues AS $key=>$value)
        {
            $this->$key = $value;
        }
    }


    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var int
     *
     * @ORM\Column(name="hourlyRate", type="integer")
     */
    private $hourlyRate;

    /**
     * @var string
     *
     * @ORM\Column(name="tagline", type="string", length=255, nullable=true)
     */
    private $tagline;

    /**
     * @var string
     *
     * @ORM\Column(name="intro", type="text", nullable=true)
     */
    private $intro;

    /**
     * @ORM\OneToMany(targetEntity="BidBundle\Entity\Bid", mappedBy="freelancer")
     */
    private $bids;

    /**
     * @ORM\OneToMany(targetEntity="BookmarkBundle\Entity\Bookmark", mappedBy="freelancer")
     */
    private $bookmarks;

    /**
     * @ORM\OneToMany(targetEntity="ReviewBundle\Entity\Review", mappedBy="freelancerReviewedId")
     */
    private $reviewId;

    /**
     * @return mixed
     */
    public function getReviewId()
    {
        return $this->reviewId;
    }

    /**
     * @param mixed $reviewId
     */
    public function setReviewId($reviewId)
    {
        $this->reviewId = $reviewId;
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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Freelancer
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Freelancer
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set hourlyRate
     *
     * @param integer $hourlyRate
     *
     * @return Freelancer
     */
    public function setHourlyRate($hourlyRate)
    {
        $this->hourlyRate = $hourlyRate;

        return $this;
    }

    /**
     * Get hourlyRate
     *
     * @return int
     */
    public function getHourlyRate()
    {
        return $this->hourlyRate;
    }

    /**
     * Set tagline
     *
     * @param string $tagline
     *
     * @return Freelancer
     */
    public function setTagline($tagline)
    {
        $this->tagline = $tagline;

        return $this;
    }

    /**
     * Get tagline
     *
     * @return string
     */
    public function getTagline()
    {
        return $this->tagline;
    }

    /**
     * Set intro
     *
     * @param string $intro
     *
     * @return Freelancer
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;

        return $this;
    }

    /**
     * Get intro
     *
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }



    /**
     * Add bid
     *
     * @param \BidBundle\Entity\Bid $bid
     *
     * @return Freelancer
     */
    public function addBid(\BidBundle\Entity\Bid $bid)
    {
        $this->bids[] = $bid;

        return $this;
    }

    /**
     * Remove bid
     *
     * @param \BidBundle\Entity\Bid $bid
     */
    public function removeBid(\BidBundle\Entity\Bid $bid)
    {
        $this->bids->removeElement($bid);
    }

    /**
     * Get bids
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBids()
    {
        return $this->bids;
    }

    /**
     * Add bookmark
     *
     * @param \BookmarkBundle\Entity\Bookmark $bookmark
     *
     * @return Freelancer
     */
    public function addBookmark(\BookmarkBundle\Entity\Bookmark $bookmark)
    {
        $this->bookmarks[] = $bookmark;

        return $this;
    }

    /**
     * Remove bookmark
     *
     * @param \BookmarkBundle\Entity\Bookmark $bookmark
     */
    public function removeBookmark(\BookmarkBundle\Entity\Bookmark $bookmark)
    {
        $this->bookmarks->removeElement($bookmark);
    }

    /**
     * Get bookmarks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBookmarks()
    {
        return $this->bookmarks;
    }

    /**
     * Add reviewId
     *
     * @param \ReviewBundle\Entity\Review $reviewId
     *
     * @return Freelancer
     */
    public function addReviewId(\ReviewBundle\Entity\Review $reviewId)
    {
        $this->reviewId[] = $reviewId;

        return $this;
    }

    /**
     * Remove reviewId
     *
     * @param \ReviewBundle\Entity\Review $reviewId
     */
    public function removeReviewId(\ReviewBundle\Entity\Review $reviewId)
    {
        $this->reviewId->removeElement($reviewId);
    }
}
