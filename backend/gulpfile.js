var gulp = require('gulp');
var connect = require('gulp-connect-php');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var autoprefixer = require('gulp-autoprefixer');
var cleanCSS = require('gulp-clean-css');
var path = require('path');
var lessautoprefix = require('less-plugin-autoprefix');
var browsersync  = require('browser-sync');
var bourbon = require('node-bourbon');
var svgmin = require('gulp-svgmin');
var svgstore = require('gulp-svgstore');

gulp.task('connect:sync', function () {
    connect.server({}, function () {
        browsersync({
            proxy: 'anycomp.loc/',
            notify: false
        });
    });
});

gulp.task('scripts', function() {
    return gulp.src([
            './resources/assets/js/**/*.js',
        ])
        .pipe(sourcemaps.init())
        .pipe(uglify())
        .pipe(rename({suffix: '.min', prefix : ''}))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./public/scripts/'))
});

gulp.task('scripts:libs', function() {
    return gulp.src([
            './bower_components/parallax.js/parallax.js',
            './bower_components/device.js/lib/device.js',
            './bower_components/waypoints/lib/jquery.waypoints.js',
            './bower_components/jquery-ui/jquery-ui.js',
            './bower_components/jquery.maskedinput/dist/jquery.maskedinput.js',
            './bower_components/owl.carousel/dist/owl.carousel.min.js',
            './bower_components/clamp-js/clamp.min.js',
        ])
        .pipe(sourcemaps.init())
        .pipe(concat('libs.min.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./public/scripts/'))
});

gulp.task('styles', function () {
    return gulp.src('./resources/assets/sass/**/*.sass')
        .pipe(sourcemaps.init())
        .pipe(sass({
            includePaths: bourbon.includePaths
        }).on('error', sass.logError))
        .pipe(rename({suffix: '.min', prefix : ''}))
        .pipe(cleanCSS())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./public/styles/'))
        .pipe(browsersync.reload({stream: true}));
});

gulp.task('svg:makefile', function () {
    return gulp
        .src("resources/assets/svg/**/*.svg")
        .pipe(svgmin(function (file) {
            var prefix = path.basename(file.relative, path.extname(file.relative));
            return {
                plugins: [{
                    cleanupIDs: {
                        prefix: prefix + '-',
                        minify: true
                    }
                }]
            }
        }))
        .pipe(svgstore())
        .pipe(gulp.dest("resources/assets/img"));
});

gulp.task('watch', ['connect:sync'], function () {
    gulp.watch('./resources/assets/sass/**/*.sass', ['styles']);
    gulp.watch('./resources/assets/js/**/*.js', ['scripts'], browsersync.reload);
    gulp.watch('./resources/views/**/*.php', browsersync.reload);
});

gulp.task('build', ['styles', 'scripts']);

gulp.task('default', ['watch']);