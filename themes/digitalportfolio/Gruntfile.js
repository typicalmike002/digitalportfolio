module.exports = function(grunt) {

	//Loads all grunt tasks matching the ['grunt-*', '@*/grunt-*'] patterns.
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		watch: {
			options: {
				livereload: true,
			},
			config: {
				files: ['package.json', 'Gruntfile.js'],
				tasks: ['jshint', 'gitadd']
			},
			scss: {
				files: ['css/sass/*.scss', 'css/sass/**/*.scss'],
				tasks: ['compass', 'combine_mq', 'autoprefixer', 'cssmin', 'gitadd'],
				options: {
					spawn: false
				}
			},
			scripts: {
				files: ['js/config.js', 'js/modules/**/*.js'],
				tasks: ['jshint', 'requirejs', 'gitadd'],
				options: {
					spawn: false
				}
			},
			images: {
				files: ['images/**/*.{png,jpg,gif}'],
				tasks: ['gitadd']
			},
			src: {
				files: ['**/*.php','screenshot.png'],
				tasks: ['gitadd']
			}
		},

		gitadd: {
			task: {
				options: {
					all: true,
					force: true
				},
				files: {
					src: [
					'*.{php,png,css,rb,json,js}',
					'js/**/*.{js,htc}',
					'css/*.css',
					'css/sass/**/*.{scss,sass}',
					'page_templates/*.php',
					'images/*.{png,jpg,gif}'
					]
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
				src: 'css/style.css',
				dest: 'css/style.css'
			}
		},

		autoprefixer: {
			options: {
				browsers: ['last 10 versions', 'ie 8', 'ie 9', '> 0.5%']
			},
			main: {
				expand: true,
				flatten: true,
				src: 'css/style.css',
				dest: 'css/'
			}
		},

		cssmin: {
			target: {
				files: [{
					expand: true,
					cwd: 'css',
					src: ['style.css']
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
					optimize: 'none',
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
		'grunt-autoprefixer',
		'grunt-contrib-cssmin',
		'grunt-contrib-combine-mq',
		'grunt-contrib-compass',
		'grunt-contrib-jshint',
		'grunt-contrib-requirejs'
	]);
};
