module.exports = function(grunt) {

	//Loads all grunt tasks matching the ['grunt-*', '@*/grunt-*'] patterns.
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		watch: {
			options: {
				livereload: true,
			},
			src: {
				files: [
					'**/*.php',
					'**/*.css',
					'js/**/*.js',
					'css/sass/**/*.scss',
					'package.json',
					'**/*.png', 
					'**/*.jpg', 
					'**/*.gif',
					'Gruntfile.js',
					'!node_modules/*', 
				],
				tasks: ['gitadd', 'gitcommit']
			},
			scss: {
				files: ['css/sass/*.scss', 'css/sass/**/*.scss'],
				tasks: ['compass', 'combine_mq', 'cssmin'],
				options: {
					spawn: false
				}
			},
			scripts: {
				files: ['js/config.js', 'js/modules/**/*.js'],
				tasks: ['jshint', 'requirejs']
			}
		},

		gitadd: {
			task: {
				options: {
					force: true
				},
				files: {
					src: ['*']
				}
			}
		},

		gitcommit: {
			your_target: {
				options: {
					cwd: '../../',
					message: function() {
						var now = new Date(),
							date = [ now.getMonth() + 1, now.getDate(), now.getFullYear() ],
							time = [ now.getHours(), now.getMinutes(), now.getSeconds() ],
							suffix = ( time[0] < 12 ) ? 'AM' : 'PM';

						// Convert hour from military time.
						time[0] = ( time[0] < 12 ) ? time[0] : time[0] - 12;

						// If hour is 0, set it to 12.
						time[0] = time[0] || 12;

						// If seconds and minutes are less than 10, add a zero.
						for (var i = 1; i < 3; i++) {
							if (time[i] < 10) {
								time[i] = "0" + time[i];
							}
						}

						// Return the date and time formatted as a string.
						return date.join('/') + ' ' + time.join(':') + ' ' + suffix;
					}
				},
				files: [{
					src: ["*"],
					expand: true,
					cwd: 'themes/digitalportfolio'
				}]
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
		'grunt-contrib-grunt-git',
		'grunt-contrib-cssmin',
		'grunt-contrib-combine-mq',
		'grunt-contrib-compass',
		'grunt-contrib-jshint',
		'grunt-contrib-requirejs'
	]);
};