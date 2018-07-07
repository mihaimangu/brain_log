var gulp        = require('gulp');
var sass        = require('gulp-sass');
var browserSync = require('browser-sync').create();

gulp.task('serve', ['sass'], function() {
    browserSync.init({
        proxy: "localhost/brain_log"
    });
    gulp.watch("src/css/*.scss", ['sass']);
    gulp.watch("application/**/*.php").on('change', browserSync.reload);
});

gulp.task('sass', function() {
    return gulp.src("src/css/main.scss")
        .pipe(sass())
        .pipe(gulp.dest("assets/css"))
        .pipe(browserSync.stream());
});

gulp.task('default', ['serve']);