var gulp = require("gulp");
var $ = require("gulp-load-plugins")();

var sassPaths = [
  "node_modules/normalize.scss/sass",
  "node_modules/foundation-sites/scss",
  "node_modules/motion-ui/src"
];

gulp.task("sass", function() {
  return gulp
    .src("assets/scss/*.scss")
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: sassPaths,
        outputStyle: "compressed"
      }).on("error", $.sass.logError)
    )
    .pipe($.autoprefixer())
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest("typo3conf/ext/site_package/Resources/Public/css"));
});

gulp.task("sass_templates", function() {
  return gulp
    .src("assets/scss/*.scss")
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass({
        includePaths: sassPaths,
        outputStyle: "compressed"
      }).on("error", $.sass.logError)
    )
    .pipe($.autoprefixer())
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest("assets/css"));
});

gulp.task(
  "default",
  gulp.series("sass", "sass_templates", function(cb) {
    gulp.watch("assets/scss/*/*.scss", gulp.series("sass", "sass_templates"));
    cb();
  })
);
