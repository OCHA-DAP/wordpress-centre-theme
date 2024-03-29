// ==== LIVERELOAD ==== //

var gulp        = require('gulp'),
    plugins     = require('gulp-load-plugins')({ camelize: true }),
    config      = require('../../gulpconfig').livereload;

// Start the livereload server; not asynchronous
gulp.task('livereload', function() {
  gulp.series('build')();
  plugins.livereload.listen(config.port, function (err) {
    if (err) {
      return console.log(err);
    }
  });
});
