WXREventBundle
==============

Installation
------------

### DoctrineExtensions

Event need sluggable behavior to build unique slug from title.

-   [StofDoctrineExtensionsBundle documentation](github.com/stof/StofDoctrineExtensionsBundle)
-   [DoctrineExtensions documentation](github.com/l3pp4rd/DoctrineExtensions)


Configuration
-------------

WXREventBundle doesn't require any configuration.

### Default configuration

``` yaml
wxr_event:
    translation_domain: WXREventBundle
    event:
        class:   WXR\EventBundle\Entity\Event
        admin:   wxr_event.event.admin.default
        manager: wxr_event.event.manager.default
    category:
        class:   WXR\EventBundle\Entity\Category
        admin:   wxr_event.category.admin.default
        manager: wxr_event.category.manager.default
    tag:
        class:   WXR\EventBundle\Entity\Tag
        admin:   wxr_event.tag.admin.default
        manager: wxr_event.tag.manager.default
```