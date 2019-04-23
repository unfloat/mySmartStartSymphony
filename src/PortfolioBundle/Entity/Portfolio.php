<?php

namespace PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Portfolio
 *
 * @ORM\Table(name="portfolio")
 * @ORM\Entity(repositoryClass="PortfolioBundle\Repository\PortfolioRepository")
 * @Vich\Uploadable
 */
class Portfolio
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
     * @ORM\Column(name="skills", type="text")
     */
    private $skills;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="previousExperiences", type="text")
     */
    private $previousExperiences;


    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\Freelancer")
     * @ORM\JoinColumn(name="freelancer_id", referencedColumnName="id")
     */
    private $freelancer;


    /**
     * @Vich\UploadableField(mapping="devis", fileNameProperty="devisName",nullable=true)
     *
     * @var File
     */
    private $devisFile;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     * @var string
     */
    private $devisName;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @return mixed
     */
    public function getPreviousExperiences()
    {
        return $this->previousExperiences;
    }

    /**
     * @param mixed $previousExperiences
     */
    public function setPreviousExperiences($previousExperiences)
    {
        $this->previousExperiences = $previousExperiences;
    }





    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $devis
     *
     * @return Devis
     */
    public function setDevisFile(File $devis = null)
    {
        $this->devisFile = $devis;

        if ($devis)
            $this->updatedAt = new \DateTimeImmutable();

        return $this;
    }

    /**
     * @return File|null
     */
    public function getDevisFile()
    {
        return $this->devisFile;
    }

    /**
     * @param string $devisName
     *
     * @return Devis
     */
    public function setDevisName($devisName)
    {
        $this->devisName = $devisName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDevisName()
    {
        return $this->devisName;
    }


    /**
     * @return mixed
     */
    public function getFreelancer()
    {
        return $this->freelancer;
    }

    /**
     * @param mixed $freelancer
     */
    public function setFreelancer($freelancer)
    {
        $this->freelancer = $freelancer;
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
     * Set skills
     *
     * @param string $skills
     *
     * @return Portfolio
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
     * Set description
     *
     * @param string $description
     *
     * @return Portfolio
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


}

