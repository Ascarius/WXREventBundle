<?php

namespace WXR\EventBundle\Model;

use WXR\CommonBundle\Model\BaseManagerInterface;

interface EventManagerInterface extends BaseManagerInterface
{
    /**
     * Find one by slug
     *
     * @param string
     * @return EventInterface|null
     */
    public function findOneBySlug($slug);

    /**
     * Find future ones
     *
     * @param integer|null $limit
     * @param integer|null $offset
     * @return EventInterface[]
     */
    public function findFutureOnes($limit = null, $offset = null);

    /**
     * Count future ones
     *
     * @return integer
     */
    public function countFutureOnes();

    /**
     * Find current ones
     *
     * @param integer|null $limit
     * @param integer|null $offset
     * @return EventInterface[]
     */
    public function findCurrentOnes($limit = null, $offset = null);

    /**
     * Count current ones
     *
     * @return integer
     */
    public function countCurrentOnes();

    /**
     * Find past ones
     *
     * @param integer|null $limit
     * @param integer|null $offset
     * @return EventInterface[]
     */
    public function findPastOnes($limit = null, $offset = null);

    /**
     * Count past ones
     *
     * @return integer
     */
    public function countPastOnes();

    /**
     * Find by category
     *
     * @param CategoryInterface $category
     * @param integer|null $limit
     * @param integer|null $offset
     * @return EventInterface[]
     */
    public function findByCategory(CategoryInterface $category, $limit = null, $offset = null);

    /**
     * Count by category
     *
     * @param CategoryInterface $category
     * @return integer
     */
    public function countByCategory(CategoryInterface $category);

    /**
     * Find by tag
     *
     * @param TagInterface $tag
     * @param integer|null $limit
     * @param integer|null $offset
     * @return EventInterface[]
     */
    public function findByTag(TagInterface $tag, $limit = null, $offset = null);

    /**
     * Count by tag
     *
     * @param TagInterface $tag
     * @return integer
     */
    public function countByTag(TagInterface $tag);

    /**
     * Find closest event
     *
     * @return EventInterface|null
     */
    public function findClosest();

    /**
     * Find previous/older event
     *
     * @param EventInterface $event
     * @return EventInterface|null
     */
    public function findPreviousOf(EventInterface $event);

    /**
     * Find next/newer event
     *
     * @param EventInterface $event
     * @return EventInterface|null
     */
    public function findNextOf(EventInterface $event);

    /**
     * Find distinct months
     *
     * @return \DateTime[]
     */
    public function findArchivedMonths();

    /**
     * Find distinct year
     *
     * @return integer[]
     */
    public function findArchivedYears();

    /**
     * Find distinct starts
     *
     * @return \DateTime[]
     */
    public function findArchivedStarts();
}
