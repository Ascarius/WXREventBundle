<?php

namespace WXR\EventBundle\Entity;

use Doctrine\ORM\EntityManager;

use WXR\CategoryBundle\Entity\CategoryManager as BaseCategoryManager;
use WXR\EventBundle\Model\CategoryManagerInterface;

class CategoryManager extends BaseCategoryManager implements CategoryManagerInterface
{
    /**
     * Post FQCN
     *
     * @var string
     */
    protected $eventClass;

    public function __construct(EntityManager $em, $class, $eventClass)
    {
        parent::__construct($em, $class);
        $this->eventClass = $eventClass;
    }

    /**
     * {@inheritDoc}
     */
    public function findWithEvents($limit = null, $offset = null)
    {
        $qb = $this->getQueryBuilder(false, array(), null, $limit, $offset);

        $qb->andWhere(
            'EXISTS ('
               . 'SELECT event.id '
               . 'FROM '.$this->eventClass.' event '
               . 'INNER JOIN event.categories cat '
               . 'WHERE cat.id = '.$this->alias.'.id '
          . ')'
        );

        return $qb->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function countWithEvents($limit = null, $offset = null)
    {
        $qb = $this->getQueryBuilder(true, array(), null, $limit, $offset);

        $qb->andWhere(
            'EXISTS ('
               . 'SELECT event.id '
               . 'FROM '.$this->eventClass.' event '
               . 'INNER JOIN event.categories cat '
               . 'WHERE cat.id = '.$this->alias.'.id '
          . ')'
        );

        return $qb->getQuery()->getSingleScalarResult();
    }
}
