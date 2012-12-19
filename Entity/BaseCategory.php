<?php

namespace WXR\EventBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use WXR\CategoryBundle\Entity\BaseCategory as BaseBaseCategory;
use WXR\EventBundle\Model\CategoryInterface;
use WXR\EventBundle\Model\EventInterface;

class BaseCategory extends BaseBaseCategory implements CategoryInterface
{
}
