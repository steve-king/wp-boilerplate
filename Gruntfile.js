module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        options: {
          style: 'compressed'
        },
        files: {
          'wp/wp-content/themes/wp-boilerplate/css/main.css': 'wp/wp-content/themes/wp-boilerplate/scss/main.scss'
        }
      }
    },
    watch: {
      sass : {
        files: ['wp/wp-content/themes/wp-boilerplate/scss/*.scss'],
        tasks: ['sass']
      },
      js : {
        files: ['wp/wp-content/themes/wp-boilerplate/js/*.js',
                'wp/wp-content/themes/wp-boilerplate/js/**/*.js',
                '!wp/wp-content/themes/wp-boilerplate/js/vendor/*',
                '!wp/wp-content/themes/wp-boilerplate/js/plugins.js'],
        tasks: ['jshint']
      }
    },
    jshint: {
      options: {
        smarttabs: true
      },
      src: ['wp/wp-content/themes/wp-boilerplate/js/*.js',
            'wp/wp-content/themes/wp-boilerplate/js/**/*.js',
            '!wp/wp-content/themes/wp-boilerplate/js/vendor/*',
            '!wp/wp-content/themes/wp-boilerplate/js/plugins.js']
    }
  });

  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // default tasks run in development
  grunt.registerTask('default', ['sass', 'jshint']);
};