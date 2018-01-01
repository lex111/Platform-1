<?xml version="1.0" encoding="UTF-8"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach($books as $book)
        <url>
            <loc>{{ $book->getUrl() }}</loc>
            <changefreq>hourly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>