'use strict';

import gulp from 'gulp';
import connect from 'gulp-connect-php';
import uglify from'gulp-uglify';
import concat from'gulp-concat';
import sass from'gulp-sass';
import rename from'gulp-rename';
import autoprefixer from'gulp-autoprefixer';
import cleanCSS from'gulp-clean-css';
import path from'path';
import browsersync from'browser-sync';
import bourbon from'node-bourbon';
import svgmin from'gulp-svgmin';
import svgstore from'gulp-svgstore';
import plumber from'gulp-plumber';
import gutil from'gulp-util';
import filesize from'gulp-filesize';
import cssBase64 from'gulp-css-base64';
import stripDebug from'gulp-strip-debug';
import gulpif from'gulp-if';
import sourcemaps from'gulp-sourcemaps';
import clean from'gulp-clean';
import yargs from 'yargs';
import gulpsync from 'gulp-sync';
import babel from 'gulp-babel';

const argv = yargs.argv;
const sync = gulpsync(gulp);

const cmd = {
    connect: 'connect',
    scripts: 'scripts',
    scriptsLibs: 'scripts:libs',
    scriptsCopy: 'scripts:copy',
    styles: 'styles',
    svg: 'svg',
    watch: 'watch',
    clean: 'clean'
};

gulp.task(cmd.connect, function () {
    connect.server({}, function () {
        browsersync({
            proxy: 'anycomp.loc/',
            notify: false
        });
    });
});

gulp.task(cmd.clean, function () {
    return gulp.src('./public/scripts', {read: false})
        .pipe(clean());
});

gulp.task(cmd.scripts, function () {
    return gulp.src([
        './resources/assets/js/**/*.js'
    ])
        .pipe(plumber())
        .pipe(filesize())
        .pipe(gulpif(!argv.production, sourcemaps.init()))
        .pipe(babel())
        .pipe(gulpif(argv.production, stripDebug()))
        .pipe(gulpif(argv.production, uglify()))
        .pipe(concat('admin.min.js'))
        .pipe(gulpif(!argv.production, sourcemaps.write()))
        .pipe(plumber.stop())
        .pipe(gulp.dest('./public/scripts/'))
        .pipe(filesize())
        .on('error', gutil.log)
});

gulp.task(cmd.scriptsCopy, function () {
    return gulp.src([
        './resources/assets/libs/ajax_upload.js'
    ])
        .pipe(gulp.dest('./public/scripts/libs'))
});

gulp.task(cmd.scriptsLibs, [cmd.scriptsCopy], function () {
    return gulp.src([
        './node_modules/jquery/dist/jquery.js',
        './node_modules/jquery.maskedinput/src/jquery.maskedinput.js'
    ])
        .pipe(plumber())
        .pipe(filesize())
        .pipe(gulpif(argv.production, stripDebug()))
        .pipe(gulpif(argv.production, uglify()))
        .pipe(concat('libs.min.js'))
        .pipe(plumber.stop())
        .pipe(gulp.dest('./public/scripts/'))
        .pipe(filesize())
        .on('error', gutil.log);
});

gulp.task(cmd.styles, function () {
    return gulp.src('./resources/assets/sass/**/*.sass')
        .pipe(gulpif(!argv.production, sourcemaps.init()))
        .pipe(sass(
            {
                includePaths: bourbon.includePaths
            }
        ).on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(cssBase64({
            baseDir: './resources/assets/images',
            extensionsAllowed: ['.jpg', '.png', '.gif', '.svg']
        }))
        .pipe(rename({suffix: '.min', prefix: ''}))
        .pipe(cleanCSS())
        .pipe(gulpif(!argv.production, sourcemaps.write()))
        .pipe(gulp.dest('./public/styles/'))
        .pipe(browsersync.reload({stream: true}))
});

gulp.task(cmd.svg, function () {
    return gulp
        .src("./resources/assets/images/svg/**/*.svg")
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
        .pipe(rename({basename: 'compressed', extname: '.svg'}))
        .pipe(gulp.dest("./resources/assets/images"));
});

gulp.task(cmd.watch, [cmd.connect], function () {
    gulp.watch('./resources/assets/sass/**/*.sass', [cmd.styles]);
    gulp.watch('./resources/assets/js/**/*.js', [cmd.scripts], browsersync.reload);
    gulp.watch('./resources/views/**/*.php', browsersync.reload);
});

gulp.task('build', sync.sync([cmd.clean, cmd.scriptsLibs, cmd.scripts, cmd.styles]));

gulp.task('default', [cmd.watch]);
