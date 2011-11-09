Smarty plugin cssEmbed
----------------------

A simple smarty plugin to improve front-end performance by embedding in-page CSS rather than in an external file when the file is too small.

Usage:

``` html
{cssEmbed media="screen" href="/css/main.css" threshold="15000"}
```

The media parameter is optional, and is a simple mapping of the `<link>` media attribute. So you can specify any media query in here.
The threshold is also optional, with a default value of 10000. If the file weights less than "threshold" bytes, then it will be embedded in-page. If it weights more, the file is left external.

Particularly efficient when used along with [assetic-smarty](https://github.com/pjparra/assetic-smarty)
