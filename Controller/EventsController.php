<?php

namespace WXR\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventsController extends Controller
{
    public function listAction($page = 1)
    {
        $request = $this->getRequest();
        $eventManager = $this->getEventManager();

        $eventCount = $eventManager->countFutureOnes();
        $limit = 10;
        $pageCount = $eventCount > 0 ? (int) ceil($eventCount / $limit) : 1;

        if ($page < 1) {
            $page = 1;
        } elseif ($page > $pageCount) {
            $page = $pageCount;
        }

        $offset = ($page - 1) * $limit;

        $events = $eventManager->findFutureOnes($limit, $offset);

        $currents = $eventManager->findCurrentOnes();

        return $this->render('WXREventBundle:Events:list.html.twig', compact(
            'currents',
            'events',
            'eventCount',
            'page',
            'pageCount'
        ));
    }

    public function showAction($slug)
    {
        $eventManager = $this->getEventManager();

        $event = $eventManager->findOneBySlug($slug);

        if ($event) {
            $previous = $eventManager->findPrevious($event);
            $next = $eventManager->findNext($event);
        } else {
            $previous = null;
            $next = null;
        }

        return $this->render('WXREventBundle:Events:show.html.twig', compact(
            'event',
            'previous',
            'next'
        ));
    }

    public function categoryAction($slug, $page)
    {
        $categoryManager = $this->getCategoryManager();
        $eventManager = $this->getEventManager();

        $category = $categoryManager->findOneBySlug($slug);

        if (null === $category) {
            throw $this->createNotFoundException('This category does not exist');
        }

        $eventCount = $eventManager->countByCategory($category);
        $limit = 10;
        $pageCount = $eventCount > 0 ? (int) ceil($eventCount / $limit) : 1;

        if ($page < 1) {
            $page = 1;
        } elseif ($page > $pageCount) {
            $page = $pageCount;
        }

        $offset = ($page - 1) * $limit;

        $events = $eventManager->findByCategory($category, $limit, $offset);

        return $this->render('WXREventBundle:Events:category.html.twig', compact(
            'category',
            'events',
            'eventCount',
            'page',
            'pageCount'
        ));
    }

    public function tagAction($slug, $page)
    {
        $tagManager = $this->getTagManager();
        $eventManager = $this->getEventManager();

        $tag = $tagManager->findOneBySlug($slug);

        if (null === $tag) {
            throw $this->createNotFoundException('This tag does not exist');
        }

        $eventCount = $eventManager->countByTag($tag);
        $limit = 10;
        $pageCount = $eventCount > 0 ? (int) ceil($eventCount / $limit) : 1;

        if ($page < 1) {
            $page = 1;
        } elseif ($page > $pageCount) {
            $page = $pageCount;
        }

        $offset = ($page - 1) * $limit;

        $events = $eventManager->findByTag($tag, $limit, $offset);

        return $this->render('WXREventBundle:Events:tag.html.twig', compact('tag', 'events', 'eventCount', 'page', 'pageCount'));
    }

    /**
     * @return WXR\EventBundle\Model\EventManagerInterface
     */
    protected function getEventManager()
    {
        return $this->get('wxr_event.event.manager');
    }

    /**
     * @return WXR\EventBundle\Model\CategoryManagerInterface
     */
    protected function getCategoryManager()
    {
        return $this->get('wxr_event.category.manager');
    }

    /**
     * @return WXR\EventBundle\Model\TagManagerInterface
     */
    protected function getTagManager()
    {
        return $this->get('wxr_event.tag.manager');
    }
}
