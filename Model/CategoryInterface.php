<?php

namespace WXR\EventBundle\Model;

use WXR\CategoryBundle\Model\CategoryInterface as BaseCategoryInterface;

interface CategoryInterface extends BaseCategoryInterface
{
    /**
     * Add event
     *
     * @param EventInterface $event
     * @return CategoryInterface
     */
    public function addEvent(EventInterface $event);

    /**
     * Remove event
     *
     * @param EventInterface $event
     * @return CategoryInterface
     */
    public function removeEvent(EventInterface $event);

    /**
     * Get events
     *
     * @return EventInterface[]
     */
    public function getEvents();
}
