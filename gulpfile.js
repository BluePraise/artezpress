"use strict";
const gulp = require("gulp");
const sass = require("gulp-sass");
var concat = require("gulp-concat");

sass.compiler = require("node-sass");

gulp.task("scss", () => {
	return gulp
		.src("scss/**/*.scss")
		.pipe(concat("app.scss"))
		.pipe(sass().on("error", sass.logError))
		.pipe(gulp.dest("./assets/css/"));
});

gulp.task("watch", () => {
  gulp.watch("scss/**/*.scss", (done) => {
    gulp.series(["scss"])(done);
  });
});

gulp.task("default", gulp.series("scss"));
