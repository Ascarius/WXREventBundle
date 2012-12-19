WXREventBundle
==============

Installation
------------

### SonataEasyExtendsBundle

-   [SonataEasyExtendsBundle documentation](http://sonata-project.org/bundles/easy-extends/master/doc/index.html)

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
        manager: wxr_event.event.manager.default
        admin:
            class: WXR\EventBundle\Admin\Entity\EventAdmin
            controller: SonataAdminBundle:CRUD
    category:
        manager: wxr_event.category.manager.default
        admin:
            class: WXR\EventBundle\Admin\Entity\CategoryAdmin
            controller: SonataAdminBundle:CRUD
    tag:
        manager: wxr_event.tag.manager.default
        admin:
            class: WXR\EventBundle\Admin\Entity\TagAdmin
            controller: SonataAdminBundle:CRUD
```