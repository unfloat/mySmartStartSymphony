<?php

namespace BookmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BookmarkController extends Controller
{
    public function freelancerBookmarksAction()
    {
        return $this->render('BookmarkBundle:Bookmark:freelancer_bookmarks.html.twig', array(
            // ...
        ));
    }

    public function employerBookmarksAction()
    {
        return $this->render('BookmarkBundle:Bookmark:employer_bookmarks.html.twig', array(
            // ...
        ));
    }

}
