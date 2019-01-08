# Maizzle PHP Documentation

## Developing

Maizzle PHP uses the [Jigsaw](http://jigsaw.tighten.co/) static site generator for its documentation site. 

Here is how you can generate the documentation locally:

1. Clone the repo and `cd` into the folder

    ```sh
    git clone https://github.com/maizzle/docs-php.git 
    
    cd docs-php
    ```

2. Install JS dependencies

    ```sh
    npm install
    ```

3. Install PHP dependencies for docs (requires Composer: https://getcomposer.org)

    ```sh
    composer install
    ```

4. Run the build to generate the static site

    ```sh
    npm run dev
    ```

To start a development server, use `npm run watch`.

## Contributing

Pull requests are welcome! 

If you're planning on adding major changes, please [open an issue](https://github.com/maizzle/docs-php/issues) first, so we can discuss it.

### Deploy previews

The site is hosted on Netlify, and [build deploy previews](https://www.netlify.com/blog/2016/07/20/introducing-deploy-previews-in-netlify/) are enabled for all pull requests.
