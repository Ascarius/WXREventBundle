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
        return $this->findOneBy(array(
            'slug' => $slug,
            'enabled' => true
        ));
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
                'endsAt' => array('>', $now->format('Y-m-d H:i:s'))
            ),
            array(
                'startsAt' => 'ASC'
            ),
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
                'startsAt' => array('>', $now->format('Y-m-d H:i:s'))
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
                'startsAt' => array('<', $now->format('Y-m-d H:i:s')),
                'endsAt' => array('>', $now->format('Y-m-d H:i:s'))
            ),
            array(
                'startsAt' => 'ASC'
            ),
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
                'startsAt' => array('<', $now->format('Y-m-d H:i:s')),
                'endsAt' => array('>', $now->format('Y-m-d H:i:s'))
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
                'endsAt' => array('<', $now->format('Y-m-d H:i:s'))
            ),
            array(
                'startsAt' => 'DESC'
            ),
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
                'endsAt' => array('<', $now->format('Y-m-d H:i:s'))
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
                'endsAt' => array('>', $now->format('Y-m-d H:i:s'))
            ),
            array(
                'startsAt' => 'ASC'
            ),
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
                'endsAt' => array('>', $now->format('Y-m-d H:i:s'))
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
                'endsAt' => array('>', $now->format('Y-m-d H:i:s'))
            ),
            array(
                'startsAt' => 'ASC'
            ),
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
                'endsAt' => array('>', $now->format('Y-m-d H:i:s'))
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
                'startsAt' => array('>', $now->format('Y-m-d H:i:s'))
            ),
            array(
                'startsAt' => 'ASC'
            ),
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
                'startsAt' => array('<=', $post->getstartsAt()->format('Y-m-d H:i:s')),
                'id' => array('!=', $post->getId())
            ),
            array('startsAt' => 'DESC'),
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
                'startsAt' => array('>=', $post->getstartsAt()->format('Y-m-d H:i:s')),
                'id' => array('!=', $post->getId())
            ),
            array('startsAt' => 'ASC'),
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
    public function findArchivedMonths()
    {
        $starts = $this->findArchivedStarts();
        $months = array();
        $lastMonth = null;

        foreach ($starts as $start) {
            $month = $start;
            if (null === $lastMonth || $month->format('Y-m') != $lastMonth->format('Y-m')) {
                $months[] = $month;
                $lastMonth = $month;
            }
        }

        return $months;
    }

    /**
     * {@inheritDoc}
     */
    public function findArchivedYears()
    {
        $starts = $this->findArchivedStarts();
        $years = array();
        $lastYear = null;

        foreach ($starts as $start) {
            $year = (int) $start->format('Y');
            if (null === $lastYear || $year != $lastYear) {
                $years[] = $year;
                $lastYear = $year;
            }
        }

        return $years;
    }

    /**
     * {@inheritDoc}
     */
    public function findArchivedStarts()
    {
        $dql = 'SELECT DISTINCT e.startsAt '
             . 'FROM '.$this->class.' e '
             . 'WHERE e.enabled = :enabled '
             . 'AND e.startsAt < :now '
             . 'ORDER BY e.startsAt DESC';

        $query = $this->em->createQuery($dql);

        $query->setParameter('enabled', true);
        $query->setParameter('now', date('Y-m-d H:i:s'));

        $result = $query->getResult();
        $starts = array_map('current', $result);

        return $starts;
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
}
