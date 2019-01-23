---
title: Installation
description: Learn how to setup the Maizzle PHP for development on your computer
page_order: 2
navigation:
  group: Getting Started
  order: 2
---

# Installing Maizzle PHP

## Requirements

Maizzle PHP needs a few tools installed on your machine:

### PHP

Jigsaw requires PHP 7 and Composer.

Macs come with PHP already installed, so make sure the version is at least 7. If you're on Windows, read [this](http://kizu514.com/blog/install-php7-and-composer-on-windows-10/).

For Composer, please see the guides for [Linux/Unix/OSX](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) or [Windows](https://getcomposer.org/doc/00-intro.md#installation-windows).
We suggest installing it globally, so that its executable gets added to your `$PATH`.

### Node.js and NPM {#node-npm}

For Laravel Mix to work (Tailwind, CSS inlining, BrowserSync, etc.), you need to have [Node.js and NPM](https://nodejs.org/en/download/) installed on your system.

### Git (optional) {#git}

If you're cloning the repo, you'll also need [Git](https://www.atlassian.com/git/tutorials/install-git#windows) installed.

## Installation

Maizzle PHP is a project that you clone or download from GitHub:

```sh
git clone https://github.com/maizzle/maizzle.git my-project
```

Next, `cd` into your project directory and install the dependencies:

```sh
cd my-project
```

Install PHP dependencies:

```sh
composer install
```

Install JS dependencies:

```sh
npm install
```

#### Notes

If you get an error about `composer` not being recognized as a command, make sure `~/.composer/vendor/bin` is in your `$PATH`.
