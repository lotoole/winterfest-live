var gulp = require('gulp'),
    plumber = require('gulp-plumber'),
    add = require('gulp-add-src'),
    size = require('gulp-size'),
    sass = require('gulp-sass'),
    postcss = require('gulp-postcss'),
    autoprefixer = require('autoprefixer'),
    jshint = require('gulp-jshint'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    strip = require('gulp-strip-comments'),
    livereload = require('gulp-livereload');

gulp.task('css', function () {
    var includes = [
        '../../../plugins/contact-form-7/includes/css/styles.css'
    ];

    return gulp.src(includes)
        .pipe(plumber(function (error) {
            console.error(error.message);
            this.emit('end');
        }))
        .pipe(concat('_plugins.scss'))
        .pipe(gulp.dest('sass'))
        .pipe(livereload());
});

gulp.task('sass', function () {
    var options = {
        sourceMap: true,
        outputStyle: 'compressed',
        includePaths: [
            'node_modules'
        ]
    },
    plugins = [
        autoprefixer({browsers: [
            'Chrome >= 35',
            'Firefox >= 38',
            'Edge >= 12',
            'Explorer >= 10',
            'iOS >= 8',
            'Safari >= 8',
            'Android 2.3',
            'Android >= 4',
            'Opera >= 12'
        ]})
    ];

    return gulp.src('./sass/**/*.scss')
        .pipe(plumber(function (error) {
            console.error(error.message);
            this.emit('end');
        }))
        .pipe(sass(options))
        .pipe(postcss(plugins))
        .pipe(gulp.dest('css'))
        .pipe(livereload());
});

gulp.task('jshint', function () {
    var scripts = [
        './js/head.js',
        './js/main.js'
    ];

    return gulp.src(scripts)
        .pipe(jshint())
        .pipe(jshint.reporter('jshint-stylish'))
        .pipe(jshint.reporter('fail'));
});

gulp.task('js', function () {
    var head = [
        // './node_modules/picturefill/dist/picturefill.min.js',
        './js/head.js'
    ];

    var main = [
        // Bodymovin Animations
        // './js/animations.js',

        // Custom
        './js/file.js',
        './js/main.js'
    ];

    var plugins = [
        './node_modules/bootstrap/dist/js/bootstrap.min.js',
        './node_modules/magnific-popup/dist/jquery.magnific-popup.min.js'
    ];

    gulp.src(head)
        .pipe(plumber(function (error) {
            console.error(error.message);
            this.emit('end');
        }))
        .pipe(strip())
        .pipe(size({showFiles: true}))
        .pipe(concat('head.min.js'))
        .pipe(gulp.dest('js'));

    return gulp.src(main)
        .pipe(plumber(function (error) {
            console.error(error.message);
            this.emit('end');
        }))
        .pipe(uglify())
        .pipe(add.prepend(plugins))
        .pipe(strip())
        .pipe(size({showFiles: true}))
        .pipe(concat('main.min.js'))
        .pipe(gulp.dest('js'))
        .pipe(livereload());
});

gulp.task('html', function() {
    return gulp.src('../index.php')
        .pipe(livereload());
});

gulp.task('watch', function () {
    livereload.listen();
    gulp.watch('./sass/**/*.scss', ['sass']);
    gulp.watch(['./js/main.js'], ['jshint', 'js']);
    gulp.watch('../**/*.php', ['html']);
});

gulp.task('default', [ 'css', 'sass', 'jshint', 'js', 'watch' ]);
