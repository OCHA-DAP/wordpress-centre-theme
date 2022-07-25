// ==== MAIN ==== //

var gulp = require('gulp');

// Default task chain: build -> (livereload or browsersync) -> watch
gulp.task('default', function(done) {
    gulp.series('watch')();
    done();
});

// Build a working copy of the theme
gulp.task('build', function(done) {
    gulp.series('images', 'scripts', 'styles', 'theme')();
    done();
});

// Dist task chain: wipe -> build -> clean -> copy -> compress images
// NOTE: this is a resource-intensive task!
gulp.task('dist', function(done) {
    gulp.series('images-optimize')();
    done();
});