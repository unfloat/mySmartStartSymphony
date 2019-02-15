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
     * @var int
     *
     * @ORM\Column(name="idFreelancer", type="integer")
     */
    private $idFreelancer;

    /**
     * @var string
     *
     * @ORM\Column(name="idEmployer", type="string", length=255)
     */
    private $idEmployer;


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
     * Set idFreelancer
     *
     * @param integer $idFreelancer
     *
     * @return Bookmark
     */
    public function setIdFreelancer($idFreelancer)
    {
        $this->idFreelancer = $idFreelancer;

        return $this;
    }

    /**
     * Get idFreelancer
     *
     * @return int
     */
    public function getIdFreelancer()
    {
        return $this->idFreelancer;
    }

    /**
     * Set idEmployer
     *
     * @param string $idEmployer
     *
     * @return Bookmark
     */
    public function setIdEmployer($idEmployer)
    {
        $this->idEmployer = $idEmployer;

        return $this;
    }

    /**
     * Get idEmployer
     *
     * @return string
     */
    public function getIdEmployer()
    {
        return $this->idEmployer;
    }
}

