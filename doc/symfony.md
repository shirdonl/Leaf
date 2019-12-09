[<-- Index](/doc/Readme.md)

# Symfony integration

Symfony is a great PHP framework and of course should we have some nice integration 
with it. We have provided a flex recipe in the [contrib repository](https://github.com/symfony/recipes-contrib) 
which will register the `Browser` and clients as services. But of course, you want
more! You want a proper bundle. 

Leaf is compatible with HTTPlug which means that we can use all the greatness from 
the [HTTPlugBundle](https://github.com/php-http/httplugbundle). 

## Install 

```
composer require php-http/httplug-bundle
```

## Configure

```yaml
# config/services.yaml
# This is done by the flex recipe
services: 
    Leaf\Browser: 
        calls:
            - ['addMiddleware', ['@Leaf.middleware.content_length']]
    
    Leaf.middleware.content_length:
        class: Leaf\Middleware\ContentLengthMiddleware
```

```yaml
# config/httplug.yaml
httplug:
    clients:
        my_Leaf:
            service: 'Leaf\Browser' 
```

You will now have a service named `httplug.client.my_Leaf`. You can of course add 
plugins method clients and whatever you want according to the 
[HTTPlug documentation](http://docs.php-http.org/en/latest/integrations/symfony-bundle.html).

---

Go back to [index](/doc/Readme.md).