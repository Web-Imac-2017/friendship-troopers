// Requis
var gulp = require('gulp');

// Include plugins
var plugins = require('gulp-load-plugins')(); // tous les plugins de package.json

// Variables de chemins
var source = './src'; // dossier de travail
var destination = './www'; // dossier à livrer

// Tâche "build" = LESS + autoprefixer + CSScomb + beautify (source -> destination)
gulp.task('css', function () {
  return gulp.src(source + '/scss/*.less')
    .pipe(plugins.less())
    .pipe(plugins.csscomb()) // réordonne les propriétés
    .pipe(plugins.cssbeautify({indent: '  '})) // ré indente et reformate
    .pipe(plugins.autoprefixer()) // ajoute les préfixes css3
    .pipe(gulp.dest(destination + '/assets/css/'));
}); 

// Tâche "minify" = minification CSS (destination -> destination)
gulp.task('minify', function () {
  return gulp.src(destination + '/assets/cssmin/*.css')
    .pipe(plugins.csso())
    .pipe(plugins.rename({
      suffix: '.min'
    }))
    .pipe(gulp.dest(destination + '/assets/cssmin/'));
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
gulp.task('default', ['build']);
