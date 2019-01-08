let hasbin = require('hasbin');
let fs = require('fs');
let path = require('path');

module.exports = {
  path: () => {
    if (fs.existsSync('./vendor/bin/jigsaw')) {
      return path.normalize('./vendor/bin/jigsaw')
    }

    if (hasbin.sync('jigsaw')) {
      return 'jigsaw';
    }

    console.log('Could not find Jigsaw; please install it via Composer, either locally or globally.');

    process.exit();
  }
};
