<?php

namespace WXR\EventBundle\Model;

interface EventInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set category
     *
     * @param CategoryInterface[] $categories
     * @return EventInterface
     */
    public function setCategories($categories);

    /**
     * Add category
     *
     * @param CategoryInterface $category
     * @return EventInterface
     */
    public function addCategory(CategoryInterface $category);

    /**
     * Remove category
     *
     * @param CategoryInterface $category
     * @return EventInterface
     */
    public function removeCategory(CategoryInterface $category);

    /**
     * Clear categories
     *
     * @return EventInterface
     */
    public function clearCategories();

    /**
     * Get categories
     *
     * @return CategoryInterface[]
     */
    public function getCategories();

    /**
     * Has category
     *
     * @param CategoryInterface $category
     * @return boolean
     */
    public function hasCategory(CategoryInterface $category);

    /**
     * Set tag
     *
     * @param TagInterface[] $tags
     * @return EventInterface
     */
    public function setTags($tags);

    /**
     * Add tag
     *
     * @param TagInterface $tag
     * @return EventInterface
     */
    public function addTag(TagInterface $tag);

    /**
     * Remove tag
     *
     * @param TagInterface $tag
     * @return EventInterface
     */
    public function removeTag(TagInterface $tag);

    /**
     * Clear tags
     *
     * @return EventInterface
     */
    public function clearTags();

    /**
     * Get tags
     *
     * @return TagInterface[]
     */
    public function getTags();

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return EventInterface
     */
    public function setEnabled($enabled);

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled();

    /**
     * Set slug
     *
     * @param string $slug
     * @return EventInterface
     */
    public function setSlug($slug);

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug();

    /**
     * Set title
     *
     * @param string $title
     * @return EventInterface
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set description
     *
     * @param string $description
     * @return EventInterface
     */
    public function setDescription($description);
    
    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set excerpt
     *
     * @param string $excerpt
     * @return EventInterface
     */
    public function setExcerpt($excerpt);

    /**
     * Get excerpt
     *
     * @return string
     */
    public function getExcerpt();

    /**
     * Set startAt
     *
     * @param \DateTime $startAt
     * @return EventInterface
     */
    public function setStartAt(\DateTime $startAt);

    /**
     * Get startAt
     *
     * @return \DateTime
     */
    public function getStartAt();

    /**
     * Is started
     *
     * @return boolean
     */
    public function isStarted();

    /**
     * Get started
     *
     * @return boolean
     */
    public function getStarted();

    /**
     * Set duration
     *
     * @param \DateTime $duration
     * @return EventInterface
     */
    public function setDuration(\DateTime $duration);
    
    /**
     * Get duration
     *
     * @return \DateTime
     */
    public function getDuration();    

    /**
     * Set endAt
     *
     * @param \DateTime $endAt
     * @return EventInterface
     */
    public function setEndAt(\DateTime $endAt);

    /**
     * Get endAt
     *
     * @return \DateTime
     */
    public function getEndAt();

    /**
     * Is ended
     *
     * @return boolean
     */
    public function isEnded();

    /**
     * Get ended
     *
     * @return boolean
     */
    public function getEnded();

    /**
     * Is in progress
     *
     * @return boolean
     */
    public function isInProgress();

    /**
     * Get in progress
     *
     * @return boolean
     */
    public function getInProgress();

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return EventInterface
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return EventInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt);

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * @return string
     */
    public function __toString();
}
