<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Article;
use BlogBundle\Entity\Comment;
use BlogBundle\Form\commentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/viewComment/{idArticle}", name="blog_viewComment")
 */
class CommentController extends Controller
{
    public function addCommentAction(Request $request, $idArticle)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $this->getDoctrine()->getRepository(Article::class)->find($idArticle);

        if (!is_object($article)){

            return $this->redirectToRoute('blog_viewComment', array('idArticle' => $idArticle));
        }
        $comment = new comment();
        $form = $this->createForm( commentType::class, $comment);
        $form = $form->handleRequest($request);
        if ($form->isValid())
        {
            $comment->setCreatedAt(new \DateTime('now'));
            $comment->setArticle($article);
            $article->getComments()->add($comment);
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('blog_viewComment', array('idArticle' => $idArticle));
        }
        return $this->render('@Blog/Comment/addComment.html.twig', array('form'=> $form->createView()));
    }

    public function replyCommentAction(Request $request, $idComment)
    {
        $em = $this->getDoctrine()->getManager();
        $parentComment = $this->getDoctrine()->getRepository(Comment::class)->find($idComment);
        $parentComment->getArticle();
        $idArticle = $parentComment->getArticle()->getId();
        if (!is_object($parentComment)){

            return $this->redirectToRoute('blog_viewComment', array('idArticle' => $idComment));
        }
        $comment = new comment();
        $form = $this->createForm( commentType::class, $comment);
        $form = $form->handleRequest($request);
        if ($form->isValid())
        {
            $comment->setCreatedAt(new \DateTime('now'));
            $comment->setParentComment($parentComment);
            $parentComment->getComments()->add($comment);
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('blog_viewComment', array('idArticle' => $idArticle));
        }
        return $this->render('@Blog/Comment/addComment.html.twig', array('form'=> $form->createView()));
    }

    public function viewCommentAction($idArticle)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $this->getDoctrine()->getRepository(Article::class)->find($idArticle);
        $comment = $article->getComments();
        return $this->render('@Blog/Comment/ViewComment.html.twig', array('comment'=>$comment));
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository(comment::class)->find($id);
        $comment->getArticle();
        $idArticle = $comment->getArticle()->getId();
        $form = $this->createForm( commentType::class, $comment);
        $form = $form->handleRequest($request);
        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('blog_viewComment', array('idArticle' => $idArticle));
        }
        return $this->render('@Blog/Comment/editComment.html.twig' , array('form'=> $form->createView()));
    }

    public function supprimerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $comm = $em->getRepository(comment::class)->find($id);
        $idArticle = $comm->getArticle()->getId();
        $em->remove($comm);
        $em->flush();
        return $this->redirectToRoute('blog_viewComment',array('idArticle' => $idArticle));
    }


}
