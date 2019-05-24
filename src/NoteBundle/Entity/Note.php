<?php

namespace NoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="NoteBundle\Repository\NoteRepository")
 */
class Note
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
     * @ORM\Column(name="priority", type="string", length=255)
     */
    private $priority;

    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Freelancer")
     * @ORM\JoinColumn(name="idFreelancer",referencedColumnName="id")
     */
    private $idFreelancer;

    /**
     * @return mixed
     */
    public function getIdFreelancer()
    {
        return $this->idFreelancer;
    }

    /**
     * @param mixed $idFreelancer
     */
    public function setIdFreelancer($idFreelancer)
    {
        $this->idFreelancer = $idFreelancer;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="noteName", type="string", length=255)
     */
    private $noteName;

    /**
     * @return string
     */
    public function getNoteName()
    {
        return $this->noteName;
    }

    /**
     * @param string noteName
     */
    public function setNoteName($noteName)
    {
        $this->noteName = $noteName;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="noteText", type="text", length=255)
     */
    private $noteText;


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
     * Set priority
     *
     * @param string $priority
     *
     * @return Note
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set noteText
     *
     * @param string $noteText
     *
     * @return Note
     */
    public function setNoteText($noteText)
    {
        $this->noteText = $noteText;

        return $this;
    }

    /**
     * Get noteText
     *
     * @return string
     */
    public function getNoteText()
    {
        return $this->noteText;
    }

}

