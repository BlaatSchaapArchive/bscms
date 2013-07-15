Mobile Browser Detection Kit, v1.1
Updated: June 3rd 2009

* Introduction

Since March 2003, one of my hobbies was developing mobile web sites. Through the pass of 4 years I carefully and lovingly compiled a long list of non-desktop user agents. With the use of the included script we used these keywords to identify non-desktop browsers and auto-redirect them to our mobile site. OSNews' and Gnomefiles' mobile sites are still some of the most complete mobile sites out there, rather than a boring white page with some text on them. I believe this script can properly identify 99% of the non-desktop browsers out there.

These days though,  the mobile landscape has changed. Now the "serious" mobile web browsers support zooming and they don't die when a page is over 32KBs. And if a user doesn't have such a browser, he usually doesn't even bother browsing the web with it. However, this script might still be of some use to some webmasters, so I thought of open sourcing it (and although I wanted to do that 1-2 years ago already, I was a bit lazy to put it together for distribution).

Now, there is always the other similar project, called WURFL. The difference between WURFL and OSNews' mobile detection kit is that WURFL is mostly a cellphone WAP-targetted tool, while our kit also cares about more kinds of non-desktop browsers of (e.g. some appliances in some hotels, text browsers, gaming devices, and anything else that's really oddball). In other words, if you are interested specifically in the exact WAP capabilities of each phone model, you go with WURFL. But if you are interested in a more generic mobile site that will work with whatever browser that's non-desktop but doesn't provide capability details, then our solution is better. Use the best tool for the job.

* Usage

There are two ways to use the detect.php file. You can either use it to redirect completely to another URL where your mobile site lives, or, you can do it as we used to do it over at OSNews v3: load a different set of CSS and header files just so the "main body" of the site remains the same for both desktop and non-desktop browsers. You must edit in three places in the script the URL of your mobile/header site/file.

Then, when you load the site or the mobile header file, you must load your CSS files (if any), like this, in order to go around some older mobile Opera bugs (exactly as shown, with this media order): 
<style type="text/css" media="screen, handheld, all">

Then, if you want, you can always modify some tables or CSS code like this depending if the browser is a desktop one or not:
<? if ($Browser=="OTHER") { ?>The desktop content<? } else {?>The mobile content<? } ?>

You can also add a cookie and let your users decide if they want to use your desktop version or your mobile version (the way that MobileBurn.com does it, which is a site that uses a small part of our script).

* Advices

Here's the catch. If you really want to be compatible with the majority of the devices recognized by this script you will have to put your 1997 hat on, and write in HTML 3.2. No CSS, no javascript, and tables should usually be always 100% width. Yes, some mobile browsers can support newer technologies, but if you want good support by the majority of the non-desktop browsers you will have to write in cHTML (google it, it's a real standard). Heck, we are talking about some devices referenced in that script that can't even deal with more than 12 KBs of data per page, let alone Javascript or CSS. It's up to you.

* Optimization

We have some craft on the detect.php file, so if you want extra speed, remove the istr() function with the proper stristr() one. It will take you a bit of  time to change all these keywords though to the correct order of the stristr() -- which is why we left this hard work for you to do. ;-)

* Support

There is no support, or responsibility, assumed by this distribution. But if you have something interesting to say that I might wanna hear (e.g. a port to Python/ASP/JSP/Ruby, or a new user agent keyword), feel free to email me at eloli-AT-hotmail-DOT-com

* License

This little script is distributed under the Creative Commons "Attribution" 3.0 license. Basically, do whatever you want with it, just give us some credit if you use it: http://creativecommons.org/licenses/by/3.0/us/

* Credits

Original code and keyword collection: Eugenia Loli-Queru
Updated code: Adam Scheinberg
Copyright 2003-2009 Eugenia Loli-Queru

* Anything else?

Yes, watch "Lost"! Best TV show ever! The catch is that you will have to watch it from the very beginning to get hooked the way we have! Woohoo!