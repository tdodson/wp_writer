module.exports = function(grunt) {

    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        /** JS Hint task **/
        jshint: {
            js_target: {
                src: ['js/*.js']
            }, //js_target
            options: { force: true }, //report JSHint errors but not fail the task
        },

        /** JS Uglify task **/
        uglify: {
            my_target: {
                files: {
                    'compiled/script.js': ['js/*.js'] //compresses and combine multiple js files
                } //files
            } //my_target
        }, //uglify

        /** Sass task **/
        sass: {
            dev: {
                options: {
                    style: 'expanded',
                    sourcemap: 'auto',
                },
                files: {
                    'compiled/style-human.css': 'sass/style.scss'
                }
            },
            dist: {
                options: {
                    style: 'compressed',
                    sourcemap: 'auto',
                },
                files: {
                    'compiled/style.css': 'sass/style.scss'
                }
            }
        },

        /** Autoprefixer **/
        autoprefixer: {
            options: {
                browsers: ['last 2 versions']
            },
            // prefix all files
            multiple_files: {
                expand: true,
                flatten: true,
                src: 'compiled/*.css',
                dest: ''
            }
        },

        /** Watch task **/
        watch: {
            css: {
                files: '**/*.scss',
                tasks: ['sass', 'autoprefixer']
            },
            scripts: {
                files: ['js/*.js'],
                tasks: ['jshint', 'uglify']
            }
            
        },

        /** Browsersync task **/
        browserSync: {
                dev: {
                    bsFiles: {
                        src: '*.css'
                    },
                    options: {
                        watchTask: true,
                        proxy: 'localhost:8888'
                    }
                }
            }
    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-browser-sync');
    grunt.registerTask('default', ['browserSync', 'watch']);

}