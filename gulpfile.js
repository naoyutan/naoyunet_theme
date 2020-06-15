const gulp = require("gulp");

const changed = require('gulp-changed');
const plumber = require('gulp-plumber'); //watch中にエラー防止
const notify = require('gulp-notify'); //エラーを通知

var htdocsDir = "./"; // 公開フォルダ
var devDir = "./dev/"; // 開発フォルダ

/**
 $ npx gulp sass      //sassコンパイル
 $ npx gulp sassing   //sass監視
 $ npx gulp js        //jSバンドル
 $ npx gulp imagemin  //画像圧縮
**/

/**
 * サーバーを立ち上げる
 * $ npx gulp build-server
**/
const browsersync = require('browser-sync').create();
const connectSSI  = require('connect-ssi');
gulp.task('build-server', function (done) {
    browsersync.init({
        proxy: 'naoyu',
        // server: {
        //     baseDir: htdocsDir,
        //     middleware: [
        //         connectSSI({
        //           baseDir: htdocsDir,
        //           ext: '.html'
        //         })
        //     ]
        // }
    });
    done();
});
// ブラウザのリロード
gulp.task('browser-reload', function (done){
    browsersync.reload();
    done();
});

// ファイル更新監視
gulp.task('watch', function(done) {
    gulp.watch( htdocsDir+"**/*.{html,php}", gulp.task('browser-reload'));
    gulp.watch( sassSrc, gulp.series('sass', 'browser-reload') );
    // gulp.watch( jsSrc, gulp.series('js') );
    gulp.watch( imageSrc, gulp.series('imagemin') );
    done();
});

// タスクの実行
gulp.task('default', gulp.series('build-server', 'watch', function(done){
    done();
    console.log('Default all task done!');
}));

/**
 * sass
**/
const sass = require("gulp-sass");
const sourcemaps = require('gulp-sourcemaps');
const postcss = require('gulp-postcss');
const cssnext = require('postcss-cssnext');
const autoprefixer = require('autoprefixer');

var sassSrc = htdocsDir+'scss/*.scss';
var sassDest = htdocsDir+'css';

gulp.task('sass', function(done) {
const plugin = [
    autoprefixer()
];
return gulp
    .src(sassSrc)
    .pipe(plumber({
        errorHandler: notify.onError("Error: <%= error.message %>")
    }))
    .pipe(sourcemaps.init())
    .pipe(
      sass({
        outputStyle: "compact" // nested, expanded, compact, compressed
      }).on('error', sass.logError)
    )
    .pipe(postcss(plugin))
    .pipe(sourcemaps.write('./map'))
    .pipe(gulp.dest(sassDest));
    done();
});
// scssファイル更新監視
gulp.task('sassing', function(done) {
    gulp.watch( sassSrc, gulp.series('sass') );
    done();
});


/**
 * bundle-js
**/
const concat  = require('gulp-concat');
const uglify = require("gulp-uglify");

var jsSrc = devDir+'plugin/*.js';
var jsDest = htdocsDir+'assets/js';
gulp.task('js', function (done) {
return gulp
    .src(jsSrc)
    .pipe(plumber())
    .pipe(concat('plugins.js'))
    .pipe(uglify())
    .pipe(gulp.dest(jsDest));
    done();
});


/**
 * 画像圧縮
**/
const imagemin = require('gulp-imagemin');
const pngquant = require('imagemin-pngquant');
const mozjpeg = require('imagemin-mozjpeg');

var imageSrc = devDir+'images';
var imageDest = htdocsDir+'assets/images';

gulp.task('imagemin', function (done) {
    gulp.src(imageSrc+'/**/**/*.{jpg,jpeg,png,gif,svg}', { base: imageSrc })
    .pipe(changed(imageDest))
    .pipe(imagemin(
        [
            pngquant({
                quality: [.8, .9],
                speed: 1
            }),
            mozjpeg({ quality: 90 }),
            imagemin.svgo(),
            imagemin.gifsicle()
        ]
    ))
    .pipe(gulp.dest(imageDest));
    done();
});
