# robots.txt for http://docspen.ga/ and friends
#
# Please note: There are a lot of pages on this site, and there are
# some misbehaved spiders out there that go _way_ too fast. If you're
# irresponsible, your access to the site may be blocked.
#
# If you would like to crawl DocsPen contact us at support@docspen.com.

# advertising-related bots:
User-agent: Mediapartners-Google*
Disallow: /

# Crawlers that are kind enough to obey, but which we'd rather not have
# unless they're feeding search engines.
User-agent: UbiCrawler
Disallow: /

User-agent: DOC
Disallow: /

User-agent: Zao
Disallow: /

# Some bots are known to be trouble, particularly those designed to copy
# entire sites. Please obey robots.txt.
User-agent: sitecheck.internetseer.com
Disallow: /

User-agent: Zealbot
Disallow: /

User-agent: HTTrack
Disallow: /

User-agent: MSIECrawler
Disallow: /

User-agent: SiteSnagger
Disallow: /

User-agent: WebStripper
Disallow: /

User-agent: WebCopier
Disallow: /

User-agent: Fetch
Disallow: /

User-agent: Offline Explorer
Disallow: /

User-agent: Teleport
Disallow: /

User-agent: TeleportPro
Disallow: /

User-agent: WebZIP
Disallow: /

User-agent: linko
Disallow: /

User-agent: Microsoft.URL.Control
Disallow: /

User-agent: Xenu
Disallow: /

User-agent: larbin
Disallow: /

User-agent: libwww
Disallow: /

User-agent: ZyBORG
Disallow: /

User-agent: Download Ninja
Disallow: /

# Misbehaving: requests much too fast:
User-agent: fast
Disallow: /

#
# Sorry, wget in its recursive mode is a frequent problem.
# Please read the man page and use it properly; there is a
# --wait option you can use to set the delay between hits,
# for instance.
#
User-agent: wget
Disallow: /

#
# The 'grub' distributed client has been *very* poorly behaved.
#
User-agent: grub-client
Disallow: /


#
# Doesn't follow robots.txt anyway, but...
#
User-agent: k2spider
Disallow: /

#
# Hits many times per second, not acceptable
# http://www.nameprotect.com/botinfo.html
User-agent: NPBot
Disallow: /

# A capture bot, downloads gazillions of pages with no public benefit
# http://www.webreaper.net/
User-agent: WebReaper
Disallow: /

#
# Friendly, low-speed bots are welcome viewing article pages, but not
# dynamically-generated pages please.
#
# Inktomi's "Slurp" can read a minimum delay between hits; if your
# bot supports such a thing using the 'Crawl-delay' or another
# instruction, please let us know.
#

User-agent: *

Allow: /
Allow: /humans.txt
Allow: /books
Allow: /discover
Allow: /books/discover
Allow: /books/create
Allow: /books/*
Allow: /books/*/page/*
Allow: /books/*/chapter/*
Allow: /user/*
Allow: /@/*
Allow: /terms
Allow: /privacy
Allow: /about
Allow: /contact
Disallow: /books/*/edit
Disallow: /books/*/page/*/edit
Disallow: /books/*/chapter/*/*/edit
Disallow: /books/*/draft/*
Disallow: /books/*/sort
Disallow: /books/*/permissions
Disallow: /books/*/delete
Disallow: /books/*/draft/*/delete
Disallow: /books/*/chapter/*/*/edit
Disallow: /books/*/page/create
Disallow: /books/*/chapter/create
Disallow: /books/create
Disallow: /books/*/export/html
Disallow: /books/*/export/pdf
Disallow: /books/*/export/plaintext
Disallow: /books/*/*/*/export/html
Disallow: /books/*/*/*/export/pdf
Disallow: /books/*/*/*/export/plaintext
Disallow: /books/*/*/*//export/html
Disallow: /books/*/chapter/*/export/pdf
Disallow: /books/*/chapter/*/export/plaintext
Disallow: /message-sent
Disallow: /settings
Disallow: /search
Disallow: /git
Disallow: /trello
Disallow: /slack
Disallow: /logout
Disallow: /login

Sitemap: https://docspen.ga/sitemap.xml