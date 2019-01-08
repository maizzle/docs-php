
module.exports = {
  getHeadingText(el) {
    let text = ''
    for (var i = 0; i < el.childNodes.length; ++i) {
      if (el.childNodes[i].nodeType === 3) {
        text += el.childNodes[i].textContent
      }
    }
    return text
  },
}
