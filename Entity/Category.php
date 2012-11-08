<?php

namespace WXR\EventBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use WXR\CategoryBundle\Entity\BaseCategory;
use WXR\EventBundle\Model\CategoryInterface;
use WXR\EventBundle\Model\EventInterface;

class Category extends BaseCategory implements CategoryInterface
{
    /**
     * @var EventInterface[]
     */
    protected $events;


    public function __construct()
    {
        parent::__construct();
        $this->events = new ArrayCollection();
    }

    /**
     * {@inheritDoc}
     */
    public function addEvent(EventInterface $event)
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeEvent(EventInterface $event)
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getEvents()
    {
        return $this->events->toArray();
    }
}
