Magento2 Markdown Template Engine
============

Markdown template engine for Magento2.

This template engine is meant to be used additionally to the `.phtml` files and does not 
provide any `.md` template file.

A use case would be to replace some simple `.phtml` files with Markdown or uses the Markdown template files
as some kind of CMS.

You can write any PHP in the Markdown files. After PHP has been executed the template will be transformed
from Markdown to HTML.

Events & Configuration
-------------

The Markdown template engine class dispatches one events so that you can modify the current parser.

Event name: `markdown_init` with event object: `engine`.

Configuration options can be found Stores -> Settings -> Configuration -> Advanced -> Developer -> Markdown.

You can choose from one of the three default engines: 

- Michelf (Markdown) [https://michelf.ca/projects/php-markdown/](https://michelf.ca/projects/php-markdown/)
- MichelfExtra (Markdown Extra) [https://michelf.ca/projects/php-markdown/extra/](https://michelf.ca/projects/php-markdown/extra/)
- ParseDown [http://parsedown.org/](http://parsedown.org/) 

Frontend Integration
--------------------

Example disable WYSIWYG editor and switch even with content from the database to full Markdown support.

We're deactivating the WYSIWYG editor completely in the backend via the option

`Stores -> Configuration -> General -> Content Management -> WYSIWYG Options` with value `Disable completely`

Your template files must have the file extension `.md` to get automatically recognized.

In your theme change `catalog_product_view.xml` to 

```
    <block template="product/view/attribute.md" class="Magento\Catalog\Block\Product\View\Description" name="product.info.overview" group="detailed_info" after="product.info.extrahint">
        <arguments>
            <argument name="at_call" xsi:type="string">getShortDescription</argument>
            <argument name="at_code" xsi:type="string">short_description</argument>
            <argument name="css_class" xsi:type="string">overview</argument>
            <argument name="at_label" translate="true" xsi:type="string">none</argument>
            <argument name="title" translate="true" xsi:type="string">Overview</argument>
            <argument name="add_attribute" xsi:type="string">itemprop="description"</argument>
        </arguments>
    </block>
```

Note: We are only changing the template extension. 

```
    <block template="product/view/attribute.md" class="Magento\Catalog\Block\Product\View\Description" name="product.info.description" group="detailed_info">
        <arguments>
            <argument name="at_call" xsi:type="string">getDescription</argument>
            <argument name="at_code" xsi:type="string">description</argument>
            <argument name="css_class" xsi:type="string">description</argument>
            <argument name="at_label" xsi:type="string">none</argument>
            <argument name="title" translate="true" xsi:type="string">Details</argument>
        </arguments>
    </block>
```

@todo figure out best method to easily change the template name for those blocks.

These changes mean that product short description and long description will now be parsed with Markdown!

#### Example attribute.phtml converted to attribute.md

[Click here to view the original attribute.phtml](https://github.com/magento/magento2/blob/develop/app%2Fcode%2FMagento%2FCatalog%2Fview%2Ffrontend%2Ftemplates%2Fproduct%2Fview%2Fattribute.phtml)

The next excerpt is from `attribute.md` which only shows the last six lines:

```
... PHP stuff ...
<?php if ($_attributeValue): ?>
<div class="product attibute <?php echo $_className?>">
    <?php if ($_attributeLabel != 'none'): ?><strong class="type"><?php echo $_attributeLabel?></strong><?php endif; ?>
    <div markdown="1" class="value" <?php echo $_attributeAddAttribute;?>><?php echo $_attributeValue; ?></div>
</div>
<?php endif; ?>
```

Note that we add here `markdown="1"` into the div and we must change the parser to `michelfextra`.

That's it! All our product descriptions will now be outputted with Markdown formatting!

A hackathon project could be to replace the WYSIWYG editor with a Markdown editor in the backend.

Developers
----------

If you wish to add any other Markdown engine simply create your own module and add a `di.xml`:

```
<type name="SchumacherFM\Markdown\Framework\View\MarkdownEngineFactory">
    <arguments>
        <argument name="engines" xsi:type="array">
            <item name="myParser" xsi:type="string">\Namespace\Module\MyAwesomeMarkdownParser</item>
        </argument>
    </arguments>
</type>
```

This entry will also appear in the backend configuration section.

Your `MyAwesomeMarkdownParser` must implement: `MarkdownEngineInterface`.

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
