[![Code Climate](https://codeclimate.com/github/Formula9/Framework/badges/gpa.svg)](https://codeclimate.com/github/Formula9/Framework)
[![Test Coverage](https://codeclimate.com/github/Formula9/Framework/badges/coverage.svg)](https://codeclimate.com/github/Formula9/Framework/coverage)

# Formula 9 Framework Core Classes

This repository is a compendium of loosely coupled modules that existed in the previous version of Formula 9.
 I don't have any current plans to break it apart again. However, I may do so in the future.
 
This is primarily for my own entertainment and use. Considering how many MVC-ish PHP Frameworks there are out in 
 the wild, I can't imagine how anyone would want to use this. Other than me. As such, it is designed for my own use and with my own 
 quirky preferences. Much of it is either inspired by similar works, or includes the works of others.
 
To install use the following:
```shell
composer require formula9/framework
```
    
or add the following to composer.json
```json    
"formula9/framework" : "dev-master"
```
    
usually with 
```json    
"minimum-stability": "dev",
```    
and finally:
```shell    
composer install
```

Or you can fork it and fill your boots.

## Console

The Formula 9 Framework classes include consoles, commands and associated service providers. Included 
are the commands required to manage portions of the framework (such as cache, generating .phpstorm.meta.php, 
generating passwords as well as provide an `artisan` clone for migrations. 

## PDO, Eloquent or NineBase with Query Builder.

The current ORM option is `Illuminate Eloquent` with laravel `Model` support (including events and triggers.) However,
it is not necessary to use Eloquent or any other ORM. The framework comes with the ever-present PDO - packaged 
with a query builder and Formula Nine's `NineBase` PDO wrapper.
 
The Query Builder uses the powerfully `Opulence\QueryBuilder`, a fairly new kid on the block.

## Coming Soon

* A large number of tests exist for the framework. However, I'm not ready to release them as yet. 
* An example application of the Formula9 Framework exists. However, it is not ready for prime time.

## License

### The MIT License (MIT)

_Copyright (c) 2016 Greg Truesdell_

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

