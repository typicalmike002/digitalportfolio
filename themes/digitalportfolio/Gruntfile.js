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
		}
	});
	grunt.registerTask('default', [
		'grunt-contrib-cssmin',
		'grunt-contrib-combine-mq',
		'grunt-contrib-compass'
	]);
};