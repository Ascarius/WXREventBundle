<?php

namespace WXR\EventBundle\Entity;

use Doctrine\ORM\QueryBuilder;

use WXR\CommonBundle\Entity\BaseManager;
use WXR\EventBundle\Model\CategoryInterface;
use WXR\EventBundle\Model\EventInterface;
use WXR\EventBundle\Model\EventManagerInterface;
use WXR\EventBundle\Model\TagInterface;

class EventManager extends BaseManager implements EventManagerInterface
{
    /**
     * {@inheritDoc}
     */
    public function findOneBySlug($slug)
    {
        return $this->findOneBy(array('slug' => $slug));
    }

    /**
     * {@inheritDoc}
     */
    public function findFutureOnes($limit = null, $offset = null)
    {
        $now = new \DateTime();

        return $this->findBy(
            array(
                'enabled' => true,
                'startAt' => array('>', $now->format('Y-m-d H:i:s'))
            ),
            null,
            $limit,
            $offset
        );
    }

    /**
     * {@inheritDoc}
     */
    public function countFutureOnes()
    {
        $now = new \DateTime();

        return $this->countBy(
            array(
                'enabled' => true,
                'startAt' => array('>', $now->format('Y-m-d H:i:s'))
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function findCurrentOnes($limit = null, $offset = null)
    {
        $now = new \DateTime();

        return $this->findBy(
            array(
                'enabled' => true,
                'startAt' => array('<', $now->format('Y-m-d H:i:s')),
                'endAt' => array('>', $now->format('Y-m-d H:i:s'))
            ),
            null,
            $limit,
            $offset
        );
    }

    /**
     * {@inheritDoc}
     */
    public function countCurrentOnes()
    {
        $now = new \DateTime();

        return $this->countBy(
            array(
                'enabled' => true,
                'startAt' => array('<', $now->format('Y-m-d H:i:s')),
                'endAt' => array('>', $now->format('Y-m-d H:i:s'))
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function findPastOnes($limit = null, $offset = null)
    {
        $now = new \DateTime();

        return $this->findBy(
            array(
                'enabled' => true,
                'endAt' => array('<', $now->format('Y-m-d H:i:s'))
            ),
            null,
            $limit,
            $offset
        );
    }

    /**
     * {@inheritDoc}
     */
    public function countPastOnes()
    {
        $now = new \DateTime();

        return $this->countBy(
            array(
                'enabled' => true,
                'endAt' => array('<', $now->format('Y-m-d H:i:s'))
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function findByCategory(CategoryInterface $category, $limit = null, $offset = null)
    {
        $now = new \DateTime();

        return $this->findBy(
            array(
                'cat.id' => $category->getId(),
                'enabled' => true,
                'endAt' => array('>', $now->format('Y-m-d H:i:s'))
            ),
            null,
            $limit,
            $offset
        );
    }

    /**
     * {@inheritDoc}
     */
    public function countByCategory(CategoryInterface $category)
    {
        $now = new \DateTime();

        return $this->countBy(
            array(
                'cat.id' => $category->getId(),
                'enabled' => true,
                'endAt' => array('>', $now->format('Y-m-d H:i:s'))
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function findByTag(TagInterface $tag, $limit = null, $offset = null)
    {
        $now = new \DateTime();

        return $this->findBy(
            array(
                'tag.id' => $tag->getId(),
                'enabled' => true,
                'endAt' => array('>', $now->format('Y-m-d H:i:s'))
            ),
            null,
            $limit,
            $offset
        );
    }

    /**
     * {@inheritDoc}
     */
    public function countByTag(TagInterface $tag)
    {
        $now = new \DateTime();

        return $this->countBy(
            array(
                'tag.id' => $tag->getId(),
                'enabled' => true,
                'endAt' => array('>', $now->format('Y-m-d H:i:s'))
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function findClosest()
    {
        $now = new \DateTime();

        $event = $this->findBy(
            array(
                'enabled' => true,
                'startAt' => array('>', $now->format('Y-m-d H:i:s'))
            ),
            null,
            1
        );

        if ($event) {
            return $event[0];
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function findPreviousOf(EventInterface $post)
    {
        $posts = $this->findBy(
            array(
                'enabled' => true,
                'startAt' => array('<=', $post->getStartAt()->format('Y-m-d H:i:s')),
                'id' => array('!=', $post->getId())
            ),
            array('startAt' => 'DESC'),
            1
        );

        if ($posts) {
            return $posts[0];
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function findNextOf(EventInterface $post)
    {
        $posts = $this->findBy(
            array(
                'enabled' => true,
                'startAt' => array('>=', $post->getStartAt()->format('Y-m-d H:i:s')),
                'id' => array('!=', $post->getId())
            ),
            array('startAt' => 'ASC'),
            1
        );

        if ($posts) {
            return $posts[0];
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getSearchableProperties()
    {
        return array(
            $this->alias.'.title',
            'cat.name',
            'tag.name'
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function buildFromClause(QueryBuilder $qb, array $criteria)
    {
        parent::buildFromClause($qb, $criteria);

        $needJoins = false;

        foreach (array('_search', 'cat', 'tag') as $needle) {
            foreach ($criteria as $criterium => $value) {
                if (false !== strpos($criterium, $needle)) {
                    $needJoins = true;
                    break 2;
                }
            }
        }

        if ($needJoins) {
            $qb
                ->leftJoin($this->alias.'.categories', 'cat')
                ->leftJoin($this->alias.'.tags', 'tag')
            ;
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function buildWhereClause(QueryBuilder $qb, array $criteria)
    {
        if (!array_key_exists('enabled', $criteria)) {
            $criteria['enabled'] = true;
        }

        return parent::buildWhereClause($qb, $criteria);
    }

    /**
     * {@inheritDoc}
     */
    protected function buildOrderClause(QueryBuilder $qb, array $orderBy = null)
    {
        if (!$orderBy) {
            $orderBy = array('startAt' => 'DESC');
        }

        parent::buildOrderClause($qb, $orderBy);
    }
}
