var gulp = require('gulp');
var gulpif = require('gulp-if');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var env = process.env.GULP_ENV;

//JAVASCRIPT TASK: write one minified js file out of jquery.js
gulp.task('js_global', function () {
    return gulp.src(['app/Resources/vendor/jquery/dist/jquery.js'])
        .pipe(concat('app_global.js'))
        .pipe(gulpif(env === 'prod', uglify()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/js'));
});

//JAVASCRIPT TASK: write one minified js file out of all of my custom js files
gulp.task('js_specific', function () {
    return gulp.src(['app/Resources/assets/js/**/*.js'])
        .pipe(concat('app_specific.js'))
        .pipe(gulpif(env === 'prod', uglify()))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/js'));
});

//define executable tasks when running "gulp" command
gulp.task('default', ['js_global', 'js_specific']);