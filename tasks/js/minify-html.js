const fs = require('fs-extra')
const glob = require('glob-all')
const minify = require('html-minifier').minify

module.exports.minify = (build_path) => {
  let files = glob.sync([build_path+'/**/*.html'])

  files.map(file => {
    let html = fs.readFileSync(file, 'utf8')
    let htmlMinified = minify(html, {
      collapseWhitespace: true
    })

    fs.writeFileSync(file, htmlMinified)
  })
}
