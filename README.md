PHP-Image-Placeholder
=====================

Script creating a placeholder:

1. Pictures from Wikimedia Commons (Pretty, yet slower), or

2. Plain text with plain background (Boring, yet faster)

##Usage
```
<img src='palceholder.php' alt='testing'> <!-- Text, Default width and height : 200 x 200 !-->

<img src='placeholder.php?w=300&h=300' alt='testing'><!--Text, Customized width and height!-->

<img src='placeholder.php?t=image' alt='testing'> <!--Image, Default width and height : 200 x 200!-->

<img src='placeholder.php?t=image&w=300&h=300' alt='testing'> <!--Image, Customized width and height!-->
```
##Technical Information
PHP-Image-Placeholder is developed on:
- [Goutte](https://github.com/fabpot/Goutte)
- [ImageMagick](http://www.imagemagick.org/)

##License
MIT Licensed
