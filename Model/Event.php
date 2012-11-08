<?php

namespace WXR\EventBundle\Model;

abstract class Event implements EventInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var CategoryInterface[]
     */
    protected $categories;

    /**
     * @var TagInterface[]
     */
    protected $tags;

    /**
     * @var boolean
     */
    protected $enabled;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $excerpt;

    /**
     * @var \DateTime
     */
    protected $startAt;

    /**
     * @var \DateTime
     */
    protected $endAt;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;


    public function __construct()
    {
        $this->categories = array();
        $this->tags = array();
        $this->enabled = true;
        $this->startAt = new \DateTime();
        $this->endAt = new \DateTime();
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function setCategories($categories)
    {
        $this->clearCategories();

        foreach ($categories as $category) {
            $this->addCategory($category);
        }

        return $this;
    }


    /**
     * {@inheritDoc}
     */
    public function addCategory(CategoryInterface $category)
    {
        if (! $this->hasCategory($category)) {
            $category->addEvent($this);
            $this->categories[] = $category;
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeCategory(CategoryInterface $category)
    {
        if (false !== ($key = array_search($category, $this->categories, true))) {
            $category->removeEvent($this);
            unset($this->categories[$key]);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function clearCategories()
    {
        foreach ($this->categories as $category) {
            $category->removeEvent($this);
        }

        $this->categories = array();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * {@inheritDoc}
     */
    public function hasCategory(CategoryInterface $category)
    {
        return false !== array_search($category, $this->categories, true);
    }

    /**
     * {@inheritDoc}
     */
    public function setTags($tags)
    {
        $this->clearTags();

        foreach ($tags as $tag) {
            $this->addTag($tag);
        }

        return $this;
    }


    /**
     * {@inheritDoc}
     */
    public function addTag(TagInterface $tag)
    {
        if (! $this->hasTag($tag)) {
            $tag->addEvent($this);
            $this->tags[] = $tag;
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeTag(TagInterface $tag)
    {
        if (false !== ($key = array_search($tag, $this->tags, true))) {
            $tag->removeEvent($this);
            unset($this->tags[$key]);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function clearTags()
    {
        foreach ($this->tags as $tag) {
            $tag->removeEvent($this);
        }

        $this->tags = array();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * {@inheritDoc}
     */
    public function hasTag(TagInterface $tag)
    {
        return false !== array_search($tag, $this->tags, true);
    }

    /**
     * {@inheritDoc}
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritDoc}
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritDoc}
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritDoc}
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * {@inheritDoc}
     */
    public function setStartAt(\DateTime $startAt)
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * {@inheritDoc}
     */
    public function isStarted()
    {
        $now = new \DateTime();

        return $this->startAt < $now;
    }

    /**
     * {@inheritDoc}
     */
    public function getStarted()
    {
        return $this->isStarted();
    }

    /**
     * {@inheritDoc}
     */
    public function setEndAt(\DateTime $endAt)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * {@inheritDoc}
     */
    public function isEnded()
    {
        $now = new \DateTime();

        return $this->endAt < $now;
    }

    /**
     * {@inheritDoc}
     */
    public function getEnded()
    {
        return $this->isEnded();
    }

    /**
     * {@inheritDoc}
     */
    public function isInProgress()
    {
        $now = new \DateTime();

        return $this->startAt < $now && $now < $this->endAt;
    }

    /**
     * {@inheritDoc}
     */
    public function getInProgress()
    {
        return $this->isInProgress();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}
