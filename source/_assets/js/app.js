const helpers = require('./helpers')
const anchorJS = require('anchor-js')
const scrollToElement = require('scroll-to-element')

/**
 * Mobile menu
 */
const menuToggle = document.getElementById('menu-toggle')
const contentOverlay = document.querySelector('.content-overlay')
const nav = document.querySelector('.sidebar-navigation')
const content = document.querySelectorAll('.content')
function toggleMenu() {
  nav.getAttribute('aria-expanded') == 'true' ? nav.setAttribute('aria-expanded', 'false') : nav.setAttribute('aria-expanded', 'true')
  Array.from(content).map((el) => {
    el.classList.toggle('mobile-menu-opened')
  })
  contentOverlay.classList.toggle('hidden')
  Array.from(menuToggle.children).map((el) => {
    el.classList.toggle('hidden')
  })
}
if (menuToggle) menuToggle.addEventListener('click', toggleMenu, false)
if (contentOverlay) contentOverlay.addEventListener('click', toggleMenu, false)


function scrollToOnLoad() {
  if (window.location.hash) {
    scrollToElement(window.location.hash, {
      offset: -100,
      ease: 'out-expo',
      duration: 400
    })
  }
}
window.onload = scrollToOnLoad

/**
 * AnchorsJS
 */
const anchors = new anchorJS()
anchors.options = { placement: 'left', class: 'text-grey-dark scroll-to' }
anchors.add('.content h2, .content h3, .content h4')
let tocLinks = anchors.elements.filter((el) => ['H2'].indexOf(el.tagName) > -1).map((el) => {
  return {
    isChild: ['H3'].indexOf(el.tagName) > -1,
    text: helpers.getHeadingText(el),
    href: el.querySelector('.anchorjs-link').getAttribute('href'),
    el: el,
  }
})
let tocWrapper = document.querySelector('.quickies')
if (tocWrapper && tocLinks.length < 1) {
  tocWrapper.previousElementSibling.remove()
}
tocLinks.map(el => {
  let pl = el.isChild ? ' pl-2' : ''
  el = '<li class="mb-3'+pl+'">' +
          '<a href="'+el.href+'" class="quickie scroll-to hover:text-grey-darkest">'+el.text+'</a>' +
        '</li>'
  tocWrapper.insertAdjacentHTML('beforeend', el)
})

/**
 * Toggles
 */
let collapseables = document.querySelectorAll('.toggle-trigger, .filetree a')
const toggle = (e) => {
  e.preventDefault();
  let target = e.target
  let panel = target.nextElementSibling
  target.classList.toggle('active')
  panel.getAttribute('aria-expanded') == 'true' ? panel.setAttribute('aria-expanded', 'false') : panel.setAttribute('aria-expanded', 'true')
}
for (var i = 0; i < collapseables.length; i++) {
  if(!collapseables[i].nextElementSibling.getAttribute('aria-expanded')) collapseables[i].nextElementSibling.setAttribute('aria-expanded', 'false');
  collapseables[i].addEventListener('click', toggle, false)
}

/**
 * Smooth scroll
 */
function addScrollTo(e) {

  let offset = null !== e.target.getAttribute('data-offset') ? parseInt(e.target.getAttribute('data-offset'), 10) : -100

  if (!e.target.classList.contains('scroll-to'))
    return;

  scrollToElement(e.target.getAttribute('href'), {
    offset: offset,
    ease: 'out-expo',
    duration: 400
  })
}

document.addEventListener ? document.addEventListener('click', addScrollTo, false) : document.attachEvent('onclick', addScrollTo)
