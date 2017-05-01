'use strict'

const gulp = require("gulp")
const sass = require("gulp-sass")
const autoprefixer = require("gulp-autoprefixer")

gulp.task("sass", () => {
  gulp.src("./sass/style.scss")
    .pipe(sass({
      outputStyle:"compressed"
    }))
    .pipe(autoprefixer({
      browsers: ['last 2 versions']
    }))
    .pipe(gulp.dest("./css"))
})

gulp.task('default', () => {
  gulp.watch('./sass/*.scss', ['sass'])
})