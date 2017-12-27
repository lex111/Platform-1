# DocsPen


## Project Definition

DocsPen is an opinionated wiki system that provides a pleasant and simple out of the box experience. New users to an instance should find the experience intuitive and only basic word-processing skills should be required to get involved in creating content on DocsPen. The platform should provide advanced power features to those that desire it but they should not interfere with the core simple user experience.

DocsPen is not designed as an extensible platform to be used for purposes that differ to the statement above. 

## Development & Testing

All development on DocsPen is currently done on the master branch. When it's time for a release the master branch is merged into release with built & minified CSS & JS then tagged at it's version. Here are the current development requirements:

* [Node.js](https://nodejs.org/en/) v6.9+

SASS is used to help the CSS development and the JavaScript is run through browserify/babel to allow for writing ES6 code. Both of these are done using gulp. To run the build task you can use the following commands:

``` bash
# Build assets for development
npm run-script build

# Build and minify assets for production
npm run-script production

# Build for dev (With sourcemaps) and watch for changes
npm run-script dev
```

DocsPen has many integration tests that use Laravel's built-in testing capabilities which makes use of PHPUnit. To use you will need PHPUnit installed and accessible via command line. There is a `mysql_testing` database defined within the app config which is what is used by PHPUnit. This database is set with the following database name, user name and password defined as `docspen-test`. You will have to create that database and credentials before testing.

The testing database will also need migrating and seeding beforehand. This can be done with the following commands:

``` bash
php artisan migrate --database=mysql_testing
php artisan db:seed --class=DummyContentSeeder --database=mysql_testing
```

Once done you can run `phpunit` in the application root directory to run all tests.

## Contributing

Feel free to create issues to request new features or to report bugs and problems. Just please follow the template given when creating the issue.

Pull requests are very welcome. If the scope of your pull request is very large it may be best to open the pull request early or create an issue for it to discuss how it will fit in to the project and plan out the merge.

## License

The DocsPen source is provided under the MIT License.

## Attribution

These are the great open-source projects used to help build DocsPen:

* [Laravel](http://laravel.com/)
* [jQuery](https://jquery.com/)
* [TinyMCE](https://www.tinymce.com/)
* [CodeMirror](https://codemirror.net)
* [Vue.js](http://vuejs.org/)
* [Axios](https://github.com/mzabriskie/axios)
* [jQuery Sortable](https://johnny.github.io/jquery-sortable/)
* [Material Design Iconic Font](http://zavoloklom.github.io/material-design-iconic-font/icons.html)
* [Dropzone.js](http://www.dropzonejs.com/)
* [clipboard.js](https://clipboardjs.com/)
* [TinyColorPicker](http://www.dematte.at/tinyColorPicker/index.html)
* [markdown-it](https://github.com/markdown-it/markdown-it) and [markdown-it-task-lists](https://github.com/revin/markdown-it-task-lists)
* [Moment.js](http://momentjs.com/)
* [BarryVD](https://github.com/barryvdh)
    * [Debugbar](https://github.com/barryvdh/laravel-debugbar)
    * [Dompdf](https://github.com/barryvdh/laravel-dompdf)
    * [Snappy (WKHTML2PDF)](https://github.com/barryvdh/laravel-snappy)
    * [Laravel IDE helper](https://github.com/barryvdh/laravel-ide-helper)
* [WKHTMLtoPDF](http://wkhtmltopdf.org/index.html)
