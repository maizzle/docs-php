---
title: Reverse Stack
description: Learn how to reorder stacked columns in a mobile responsive HTML email with Maizzle PHP
page_order: 12
path: docs/examples
navigation:
  group: Examples
  order: 12
---

# Reverse Column Stacking On Mobile

With responsive HTML emails, you sometimes need to reverse the order in which stacked columns appear on mobile. 
You might even need to set a _custom_ stacking order for layouts with 3+ columns.

---

## Reverse 2 col

Imagine you have a two column layout, with text on the left and an image on the right:

```html
<table class="w-full" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td class="sm-inline-block w-1-2 sm-w-full px-8">
            <p class="text-2xl font-hairline font-sans text-black">Left text</p>
            <p class="text-grey-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore aspernatur.</p>
        </td>
        <td class="sm-inline-block w-1-2 sm-w-full px-8">
            <img src="https://picsum.photos/600/600" alt="">
        </td>
    </tr>
</table>
```

Naturally, the image will show under the text, when viewed on a mobile device:

<div class="bg-grey-light py-8 px-8 sm:px-16 xl:px-32 mb-4">
    <table class="w-full" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
        <td align="left" class="bg-white py-6 px-2">
            <table class="w-full" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td class="inline-block w-full px-2">
                        <p class="text-2xl font-hairline font-sans text-black">Left text</p>
                        <p class="text-grey-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore aspernatur.</p>
                    </td>
                    <td class="inline-block w-full px-2">
                        <img src="https://picsum.photos/600/600?image=1062" alt="" class="leading-full max-w-full align-middle">
                    </td>
                </tr>
            </table>
        </td>
        </tr>
    </table>
</div>

However, using Maizzle PHP's custom table display utilities, we can reverse the columns on the mobile breakpoint:

```html
<table class="w-full" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td class="w-1-2 sm-table-footer-group px-8">
            <div class="sm-px-8">
              <h2 class="text-2xl font-hairline font-sans text-black">Left text</h2>
              <p class="text-grey-dark mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore aspernatur.</p>
            </div>
        </td>
        <td class="w-1-2 sm-table-header-group px-8">
            <div class="sm-px-8">
              <img src="https://picsum.photos/600/600" alt="">
            </div>
        </td>
    </tr>
</table>
```

What you need to do is:

1. Use the responsive `table-{...}-group` utilities on each column, to reverse their order on small screens
2. Wrap the contents of each column in a `<div>` and use it to set padding for mobile. This is because the CSS properties used to reverse the column order do not support padding

And that would give us:

<div class="bg-grey-light py-8 px-8 sm:px-16 xl:px-32 mb-4">
    <table class="w-full" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
        <td align="left" class="bg-white py-6 px-2">
            <table class="w-full" cellpadding="0" cellspacing="0" role="presentation">
                <tr class="w-full">
                    <td class="inline-block w-full px-2" style="display: table-footer-group;">
                        <div class="px-2">
                            <p class="text-2xl font-hairline font-sans text-black mt-4">Left text</p>
                            <p class="text-grey-dark mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore aspernatur.</p>
                        </div>
                    </td>
                    <td class="inline-block w-full px-2" style="display: table-header-group;">
                        <div class="px-2">
                            <img src="https://picsum.photos/600/600?image=1062" alt="" class="leading-full max-w-full align-middle">
                        </div>
                    </td>
                </tr>
            </table>
        </td>
        </tr>
    </table>
</div>

<div class="text-center my-16">
    <a href="https://codepen.io/maizzle/pen/dgpxbB?editors=1000" target="_blank" rel="nofollow noopener" class="bg-indigo hover:bg-indigo-dark rounded shadow text-sm text-white leading-full py-4 px-12 no-underline">See a demo on CodePen ↗</a>
</div>

---

## Reorder 3+ cols

In a similar fashion, we can reorder a 3+ column layout:

```
<table class="w-full" cellpadding="0" cellspacing="0" role="presentation">
    <tr class="sm-w-full sm-table">
        <td class="w-1-3 sm-table-footer-group px-8">
            <div class="sm-px-8">
              <h2 class="text-xl font-hairline font-sans text-black">Last on mobile</h2>
            </div>
        </td>
        <td class="w-1-3 sm-table-footer-group px-8">
          <div class="sm-px-8">
            <h2 class="text-xl font-hairline font-sans text-black">Second on mobile</h2>
          </div>
        </td>
        <td class="w-1-3 sm-table-caption sm-w-full px-8">
          <h2 class="text-xl font-hairline font-sans text-black">First on mobile</h2>
        </td>
    </tr>
</table>
```

Only a couple of extra steps:

1. Make the `<tr>` act as a full width table on mobile, by adding the `sm-w-full` and `sm-table` utilities
2. Use `sm-table-caption` and `sm-w-full` on the column that you want to display first on mobile

Note: `.table-caption` supports padding, so you don't need to use a div inside the column.

<div class="text-center my-16">
    <a href="https://codepen.io/maizzle/pen/dgpxLp?editors=1000" target="_blank" rel="nofollow noopener" class="bg-indigo hover:bg-indigo-dark rounded shadow text-sm text-white leading-full py-4 px-12 no-underline">See a demo on CodePen ↗</a>
</div>
