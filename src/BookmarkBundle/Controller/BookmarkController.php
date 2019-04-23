<?php

namespace BookmarkBundle\Controller;

use BookmarkBundle\Entity\Bookmark;
use ProjectBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BookmarkController extends Controller
{
    public function freelancerBookmarksAction()
    {
        $bookmarks= $this->getDoctrine()->getRepository(Bookmark::class)->findBy(['freelancer'=>$this->getUser()]);

        return $this->render('@Bookmark/Bookmark/show_bookmarks.html.twig', array(
            'bookmarks'=>$bookmarks
        ));
    }


}
