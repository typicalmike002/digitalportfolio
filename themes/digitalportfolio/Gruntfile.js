module.exports = function(grunt) {

	//Loads all grunt tasks matching the ['grunt-*', '@*/grunt-*'] patterns.
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		watch: {
			options: {
				livereload: true,
			},
			scss: {
				files: ['css/sass/*.scss', 'css/sass/**/*.scss'],
				tasks: ['compass', 'combine_mq', 'cssmin'],
				options: {
					spawn: false
				}
			},
			scripts: {
				files: ['js/**/*.js'],
				tasks: ['jshint', 'requirejs']
			}
		},

		compass: {
			dist: {
				options: {
					config: 'config.rb',
					sassDir: 'css/sass',
					cssDir: 'css',
					environment: 'development'
				}
			}
		},

		combine_mq: {
			options: {
				beautify: true
			},
			main: {
				src: 'style.css',
				dest: 'style.css'
			}
		},

		cssmin: {
			target: {
				files: [{
					expand: true,
					cwd: 'css/sass',
					src: ['*.css']
				}]
			}
		},

		jshint: {
			all: ['Gruntfile.js']
		},

		requirejs: {
			compile: {
				options: {
					baseUrl: 'js',
					name: 'config',
					paths: {
						jquery: 'libraries/jquery-1.11.3.min',
						app: 'modules/app'
					},
					out: 'js/optimize.min.js' 
				}
			}
		}
	});
	grunt.registerTask('default', [
		'grunt-contrib-cssmin',
		'grunt-contrib-combine-mq',
		'grunt-contrib-compass',
		'grunt-contrib-jshint',
		'grunt-contrib-requirejs'
	]);
};