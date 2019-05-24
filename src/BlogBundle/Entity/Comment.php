<?php

namespace BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\Freelancer;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\CommentRepository")
 */
class Comment
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
     * @ORM\Column(name="commentContent", type="text")
     */
    private $commentContent;


    /**
     * @ORM\ManyToOne(targetEntity="Article",inversedBy = "comments", cascade={"persist"})
     * @ORM\JoinColumn(name="article_id",referencedColumnName="id", onDelete="SET NULL")
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Freelancer", inversedBy="comments", cascade={"persist", "merge"})
     * @ORM\JoinColumn(name="freelancer_id",referencedColumnName="id")
     */
    private $freelancers;

    /**
     * @var string
     *
     * @ORM\Column(name="createAt", type="date")
     */
    protected $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="parentComment",cascade={"remove"})
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="Comment",inversedBy = "comments", cascade={"persist", "merge"})
     * @ORM\JoinColumn(name="parentComment_id",referencedColumnName="id")
     */
    private $parentComment;


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
     * Set commentContent
     *
     * @param string $commentContent
     *
     * @return Comment
     */
    public function setCommentContent($commentContent)
    {
        $this->commentContent = $commentContent;

        return $this;
    }

    /**
     * Get commentContent
     *
     * @return string
     */
    public function getCommentContent()
    {
        return $this->commentContent;
    }



    /**
     * @return mixed
     */
    public function getFreelancers()
    {
        return $this->freelancers;
    }

    /**
     * @param mixed $freelancers
     */
    public function setFreelancers($freelancers)
    {
        $this->freelancers = $freelancers;
    }

    /**
     * @return ArrayCollection|article[]
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param ArrayCollection $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return mixed
     */
    public function getParentComment()
    {
        return $this->parentComment;
    }

    /**
     * @param mixed $parentComment
     */
    public function setParentComment($parentComment)
    {
        $this->parentComment = $parentComment;
    }

    public function __construct()
    {
        $this->comments  = new ArrayCollection();
    }

}