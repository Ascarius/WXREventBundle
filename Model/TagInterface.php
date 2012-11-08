<?php

namespace WXR\EventBundle\Model;

use WXR\CategoryBundle\Model\TagInterface as BaseTagInterface;

interface TagInterface extends BaseTagInterface
{
    /**
     * Add event
     *
     * @param EventInterface $event
     * @return TagInterface
     */
    public function addEvent(EventInterface $event);

    /**
     * Remove event
     *
     * @param EventInterface $event
     * @return TagInterface
     */
    public function removeEvent(EventInterface $event);

    /**
     * Get event
     *
     * @return EventInterface[]
     */
    public function getEvents();
}
