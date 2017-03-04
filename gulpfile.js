


/*

// Include plugins
var plugins = require('gulp-load-plugins')(); // tous les plugins de package.json




var gulp = require('gulp');
var postcss = require('gulp-postcss');
var less = require('gulp-less');

// Variables de chemins
var source = './src'; // dossier de travail
var destination = './www'; // dossier à livrer

var autoprefixer = require('autoprefixer');
var cssnano = require('cssnano');

gulp.task('css', function () {
  var processors = [
    autoprefixer,
    cssnano
  ];
  return gulp.src(source + '/scss/*.less')
    .pipe(less())
    .pipe(plugins.csscomb()) // réordonne les propriétés
    .pipe(plugins.cssbeautify({indent: '  '})) // ré indente et reformate
    .pipe(postcss(processors))
    .pipe(gulp.dest(destination + '/assets/css/'));
});

// Tâche "build"
gulp.task('build', ['css']);

// Tâche "prod" = Build + minify
gulp.task('prod', ['build',  'minify']);

// Tâche "watch" = je surveille *less
gulp.task('watch', function () {
  gulp.watch(source + '/scss/*.less', ['build']);
});

// Tâche par défaut
gulp.task('default', ['build']); */


// Variables de chemins
var source = './src'; // dossier de travail
var destination = './www'; // dossier à livrer

var gulp = require('gulp');
var sass = require('gulp-sass');


gulp.task('css', function () {
   gulp.src(source + '/scss/*.scss')
      .pipe(sass().on('error', sass.logError))
      .pipe(gulp.dest(destination + '/assets/css/'));
});

// Tâche "build"
gulp.task('build', ['css']);

// Tâche "prod" = Build + minify
gulp.task('prod', ['build',  'minify']);

// Tâche "watch" = je surveille *less
gulp.task('watch', function () {
  gulp.watch(source + '/scss/*.scss', ['build']);
});

// Tâche par défaut
gulp.task('default', ['build']);




