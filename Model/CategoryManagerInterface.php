<?php

namespace WXR\EventBundle\Model;

use WXR\CategoryBundle\Model\CategoryManagerInterface as BaseCategoryManagerInterface;

interface CategoryManagerInterface extends BaseCategoryManagerInterface
{
    /**
     * Find categories used in events
     *
     * @param integer|null $limit
     * @param integer|null $offset
     * @return CategoryInterface[]
     */
    public function findWithEvents($limit = null, $offset = null);

    /**
     * Count categories used in events
     *
     * @return integer
     */
    public function countWithEvents();
}
