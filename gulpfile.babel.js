import webpack from 'webpack-stream';
import gulp from 'gulp';

import pug from 'gulp-pug';
import gulpPretty from 'gulp-pretty-html';

import postcss from 'gulp-postcss';
import csso from 'gulp-csso';
import autoprefixer from 'autoprefixer';
import resets from 'scss-resets';
import gulpSass from 'gulp-sass';
import * as sassLib from 'sass';

import del from 'del';
import rename from 'gulp-rename';
import posthtml from 'gulp-posthtml';
import include from 'posthtml-include';

import svgstore from 'gulp-svgstore';

import fs from 'fs';
import realFavicon from 'gulp-real-favicon';

import imagemin from 'gulp-imagemin';

import plumber from 'gulp-plumber';
import browserSync from 'browser-sync';
import webpackConfig from './webpack.config';

const sass = gulpSass(sassLib);
const server = browserSync.create();
const FAVICON_DATA_FILE = 'faviconData.json';

gulp.task('css', () => gulp.src('frontend/source/sass/style.scss')
  .pipe(plumber())
  .pipe(sass({
    includePaths: resets.includePaths,
  }).on('error', sass.logError))
  .pipe(postcss([
    autoprefixer(),
  ]))
  .pipe(csso())
  .pipe(gulp.dest('frontend/build/css'))
  // .pipe(gulp.dest('backend/static/css'))
  .pipe(server.stream()));

gulp.task('pug', () => gulp.src([
  'frontend/source/pug/*.pug',
  'frontend/source/pug/articles/*.pug',
  'frontend/source/pug/catalog/*.pug',
])
  .pipe(plumber())
  .pipe(pug())
  .pipe(gulpPretty())
  .pipe(posthtml([
    include(),
  ]))
  .pipe(gulp.dest('frontend/build')));

gulp.task('sprite', () => gulp.src('frontend/source/img/sprite/*.svg')
  .pipe(svgstore({
    inlineSvg: true,
  }))
  .pipe(rename('sprite.svg'))
  .pipe(gulp.dest('frontend/build/img')));

gulp.task('js', () => gulp.src('frontend/source/js/index.js')
  .pipe(webpack(webpackConfig))
  .pipe(gulp.dest('frontend/build/js')));

gulp.task('favicon-generate', (done) => {
  realFavicon.generateFavicon({
    masterPicture: 'frontend/source/img/favicon.png',
    dest: 'frontend/source/img/icons',
    iconsPath: 'img/icons',
    design: {
      ios: {
        pictureAspect: 'noChange',
        assets: {
          ios6AndPriorIcons: false,
          ios7AndLaterIcons: false,
          precomposedIcons: false,
          declareOnlyDefaultIcon: true,
        },
      },
      desktopBrowser: {},
      windows: {
        pictureAspect: 'noChange',
        backgroundColor: '#ffffff',
        onConflict: 'override',
        assets: {
          windows80Ie10Tile: false,
          windows10Ie11EdgeTiles: {
            small: false,
            medium: true,
            big: false,
            rectangle: false,
          },
        },
      },
      androidChrome: {
        pictureAspect: 'backgroundAndMargin',
        margin: '23%',
        backgroundColor: '#ffffff',
        themeColor: '#ffffff',
        manifest: {
          display: 'standalone',
          orientation: 'notSet',
          onConflict: 'override',
          declared: true,
        },
        assets: {
          legacyIcon: false,
          lowResolutionIcons: false,
        },
      },
    },
    settings: {
      scalingAlgorithm: 'Lanczos',
      errorOnImageTooSmall: false,
      readmeFile: false,
      htmlCodeFile: true,
      usePathAsIs: false,
    },
    markupFile: FAVICON_DATA_FILE,
  }, () => done());
});

gulp.task('imagemin', () => gulp.src('frontend/source/img/**/*.{png,jpg}')
  .pipe(imagemin([
    imagemin.optipng({ optimizationLevel: 3 }),
    imagemin.mozjpeg({ progressive: true, quality: 80 }),
  ]))
  .pipe(gulp.dest('frontend/build/img')));

gulp.task('inject-favicon-markups', () => gulp.src('frontend/build/*.html')
  .pipe(
    realFavicon.injectFaviconMarkups(
      JSON.parse(fs.readFileSync(FAVICON_DATA_FILE)).favicon.html_code,
    ),
  )
  .pipe(gulp.dest('frontend/build')));

gulp.task('favicons', gulp.series(
  'favicon-generate',
  'inject-favicon-markups',
));

gulp.task('clean', () => del('frontend/build'));

gulp.task('copy', () => gulp.src([
  'frontend/source/fonts/**/*.{woff,woff2}',
  'frontend/source/img/**',
  'frontend/source/js/lib/*',
], {
  base: 'frontend/source',
})
  // .pipe(gulp.dest('backend/static'))
  .pipe(gulp.dest('frontend/build')));

gulp.task('server', () => {
  server.init({
    server: 'frontend/build/',
  });

  gulp.watch('frontend/source/**/*.pug', gulp.series('pug', 'refresh'));
  gulp.watch('frontend/source/img/**/*', gulp.series('copy', 'sprite', 'pug', 'inject-favicon-markups', 'refresh'));
  gulp.watch('frontend/source/js/**/*', gulp.series('js', 'refresh'));
  gulp.watch('frontend/source/sass/**/*.{scss,sass}', gulp.series('css'));
});

gulp.task('refresh', (done) => {
  server.reload();
  done();
});

gulp.task('build', gulp.series(
  'clean',
  gulp.parallel(
    'copy',
    'css',
  ),
  gulp.parallel(
    'sprite',
  ),
  gulp.parallel(
    'pug',
    'js',
  ),
  'inject-favicon-markups',
));

gulp.task('start', gulp.series(
  'build',
  'server',
));
