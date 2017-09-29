//Gulp Plugins
var gulp = require('gulp'),
    rename = require("gulp-rename"),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    minify = require('gulp-clean-css');

// Paths to resources
var JS_PATH = [
        'web/public/js/owl.carousel.min.js',
        'web/public/js/jquery.stickit.min.js',
        'web/public/js/menu.js',
        'web/public/js/scripts.js'
    ],
    CSS_PATH = 'web/public/css/*.css';

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
