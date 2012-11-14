<?php

namespace WXR\EventBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use WXR\CategoryBundle\Entity\BaseTag;
use WXR\EventBundle\Model\EventInterface;
use WXR\EventBundle\Model\TagInterface;

class Tag extends BaseTag implements TagInterface
{
}
