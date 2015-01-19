Magento2 Markdown Template Engine
============

Markdown template engine for Magento2.

This template engine is meant to be used additionally to the `.phtml` files and does not 
provide any `.md` template file.

A use case would be to replace some simple `.phtml` files with Markdown or uses the Markdown template files
as some kind of CMS *cough, cough*.

You can write any PHP in the Markdown files. After PHP has been executed the template will be transformed
from Markdown to HTML.

Future version of this module will also parse any content stored in the database.

Events & Configuration
-------------

The Markdown template engine class dispatches two events so that you can modify the parsers.

@todo

Configuration options can be found Stores -> Settings -> Configuration -> Advanced -> Developer -> Markdown.

Frontend Integration
--------------------

Your template files must have the file extension `.md` to get automatically recognized.

In your layout xml files or blocks please specify the new template:

```
@todo
```

#### Example header.phtml converted to header.twig

```
@todo
```

```
@todo
```

Tests
-----

@todo

Installation via Composer
------------

Add the following to the require section of your Magento 2 `composer.json` file

    "schumacherfm/mage2-markdown": "dev-master"

additionally add the following in the repository section

        "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/SchumacherFM/Magento2-Markdown.git"
        }
    ]
    
run `composer update`

add the following to `app/etc/config.php`

    'SchumacherFM_Markdown'=>1

Compatibility
-------------

- Magento >= 2
- php >= 5.4.0

Support / Contribution
----------------------

Report a bug using the issue tracker or send us a pull request.

Instead of forking I can add you as a Collaborator IF you really intend to develop on this module. Just ask :-)

I am using that model: [A successful Git branching model](http://nvie.com/posts/a-successful-git-branching-model/)

For versioning have a look at [Semantic Versioning 2.0.0](http://semver.org/)

History
-------

#### 0.1.0

- Initial release

License
-------

OSL-30

Author
------

[Cyrill Schumacher](http://cyrillschumacher.com)

[My pgp public key](http://www.schumacher.fm/cyrill.asc)
