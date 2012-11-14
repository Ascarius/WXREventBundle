<?php

namespace WXR\EventBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use WXR\EventBundle\Model\CategoryInterface;
use WXR\EventBundle\Model\Event;
use WXR\EventBundle\Model\TagInterface;

abstract class BaseEvent extends Event
{
    public function __construct()
    {
        parent::__construct();
        $this->categories = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    /**
     * Update updatedAt
     */
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * {@inheritDoc}
     */
    public function addCategory(CategoryInterface $category)
    {
        if (! $this->hasCategory($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeCategory(CategoryInterface $category)
    {
        if ($this->hasCategory($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function clearCategories()
    {
        $this->categories = new ArrayCollection();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function hasCategory(CategoryInterface $category)
    {
        return $this->categories->contains($category);
    }

    /**
     * {@inheritDoc}
     */
    public function addTag(TagInterface $tag)
    {
        if (! $this->hasTag($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeTag(TagInterface $tag)
    {
        if ($this->hasTag($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function clearTags()
    {
        $this->tags = new ArrayCollection();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function hasTag(TagInterface $tag)
    {
        return $this->tags->contains($tag);
    }

}
