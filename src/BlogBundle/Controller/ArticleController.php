<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use UserBundle\Entity\User;

/**
 * @method getFile()
 */
class ArticleController extends Controller
{
    public function addAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm( ArticleType::class, $article);
        $form = $form->handleRequest($request);
        if ($form->isValid())
        {
            // $file stores the uploaded PDF file
            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $article->getFile();
            $f = $file->getFilename().'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $file->move(
                    'C:\wamp\www\FooBar\web\images\uploaded',
                    $f
                );
            } catch (FileException $e) {

            }

            // updates the 'file' property to store the PDF file name
            // instead of its contents
            $em = $this->getDoctrine()->getManager();
            $article->setFile($f);
            $article->setCreatedAt(new \DateTime('now'));
            //$article->setUser($user);
            $em->persist($article);
            $em->flush();
            return $this->redirect($this->generateUrl('blog_afficheArticle'));
        }
        return $this->render('@Blog/Article/ajoutArticle.html.twig',['form'=> $form->createView()]);
    }

    public function afficheArticleAction()
    {
        $request = Request::createFromGlobals();
        $data = [];
        $keyword = $request->request->get('keyword');
        if ($keyword){
            $data = ['title' => '%'.$keyword.'%'];
        }
        $article = $this->getDoctrine()->getRepository(Article::class)->findBy($data); // pour faire select (finall)
        return $this->render('@Blog/Article/afficheArticle.html.twig', array('article'=>$article));
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->find($id);
        $form = $this->createForm( ArticleType::class, $article);
        $form = $form->handleRequest($request);
        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return $this->redirect($this->generateUrl('blog_afficheArticle'));
        }
        return $this->render('@Blog/Article/editArticle.html.twig' , array('form'=> $form->createView()));
    }

    public function supprimerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->find($id);
        $em->remove($article);
        $em->flush();
        return $this->redirect($this->generateUrl('blog_afficheArticle'));
    }

    public function listAction()
    {
        return $this->render('@Blog/Article/blogArticle.html.twig');
    }


}
