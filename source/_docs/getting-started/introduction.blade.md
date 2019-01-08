---
title: Introduction
description: Get started with the Maizzle PHP Email Framework
page_order: 1
navigation:
  group: Getting Started
  order: 1
---

# Get started with Maizzle PHP

Maizzle PHP is an email framework built with [Jigsaw](http://jigsaw.tighten.co) and [Tailwind CSS](https://tailwindcss.com/).

Whether you want to use the same modern tooling that powers your Laravel applications,
or just want to have the full power of PHP in email development, you can use Maizzle PHP
to build your HTML emails fast and be in full control over your development workflow.

---

## Jigsaw

At its core, Maizzle PHP uses [Jigsaw](http://jigsaw.tighten.co) to build your HTML files.
Jigsaw is a very powerful PHP static site generator that includes many awesome features from the [Laravel](https://laravel.com/) framework.

It offers many great features that an email framework can use, from a solid templating engine with partials and components support (Blade), to custom data structures and Webpack asset compilation.

Fun fact: this documentation is also powered by Jigsaw 💪

## Tailwind CSS

Styling HTML emails is a great use-case for functional/atomic/utility-first CSS.

Maizzle uses the [Tailwind CSS](https://tailwindcss.com/docs/what-is-tailwind/) framework and provides an email-tailored [config](https://github.com/maizzle/maizzle/blob/master/tailwind.js) that changes or disables some of the default Tailwind features, for better email client support.

You guessed it, this documentation also uses Tailwind.

## Transformers

Transformers in Maizzle PHP refer to all the email-specific post-processing functions that are applied to the output HTML files, such as CSS inlining, minification, code clean-up, etc.

They are all [configurable](https://github.com/maizzle/maizzle/blob/master/config.php#L152) from the environment-specific `config.php` file.

## Environments

Jigsaw allows you to create custom config files in order to define different build scenarios.

We call these [environments](/docs/php/configuration/#environments).
Maizzle PHP includes _local_, _staging_, and _production_ environments by default, but you can create as many as you need - each with their own settings.

Environments are just a small feature of the Jigsaw config.
As you'll see, you can use it for many other things, such as creating custom data collections or controlling Maizzle PHP's email post-processing scripts.
