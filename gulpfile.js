//Gulp Plugins
var gulp = require('gulp'),
    rename = require("gulp-rename"),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    minify = require('gulp-clean-css'),
	watch = require('gulp-watch');

// Paths to resources
var JS_PATH = [
        'vendor/bower/owl.carousel/dist/owl.carousel.js',
        'vendor/bower/jquery-stickit/build/jquery.stickit.min.js',
        'web/js/custom/scripts.js',
        'web/js/custom/menu.js'
    ],
    CSS_PATH = [
        'vendor/bower/animate.css/animate.css',
        'vendor/bower/owl.carousel/dist/assets/owl.carousel.css',
        'vendor/bower/owl.carousel/dist/assets/owl.carousel.theme.default.css',
        'web/css/custom/*.css'
    ];



//task compile js
gulp.task('simblog:min:js', function () {
    return gulp.src(JS_PATH)
        .pipe(uglify())
        .pipe(concat('simblog.min.js'))
        .pipe(rename({dirname: 'js'}))
        .pipe(gulp.dest('web/'));
});

//task compile ss
gulp.task('simblog:min:css', function () {
    return gulp.src(CSS_PATH)
        .pipe(minify({rebase: false, keepSpecialComments : 0}))
        .pipe(concat('simblog.min.css'))
        .pipe(rename({dirname: 'css'}))
        .pipe(gulp.dest('web/'));
});

//watching changes in css and js
gulp.task('watch', ['simblog:min:css', 'simblog:min:js'], function() {
    gulp.watch('web/public/**/*.css', ['simblog:min:css']);
    gulp.watch('web/public/**/*.js', ['simblog:min:js']);
});

gulp.task('default', ['watch']);