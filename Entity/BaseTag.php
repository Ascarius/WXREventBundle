<?php

namespace WXR\EventBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use WXR\CategoryBundle\Entity\BaseTag as BaseBaseTag;
use WXR\EventBundle\Model\EventInterface;
use WXR\EventBundle\Model\TagInterface;

class BaseTag extends BaseBaseTag implements TagInterface
{
}
