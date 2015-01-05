module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        'ftp-deploy': {
            build: {
                auth: {
                    host: 'vh38.hoster.by',
                    port: 21,
                    authKey: 'staging'
                },
                src: '.',
                //dest: '/public_html/test287', // for test. uploads to test.cheerick.ru
                dest: '/public_html',
                exclusions: ['./node_modules', 'Gruntfile.js', 'package.json',
                    '.ftppass', '.git', 'README.md', './.idea',
                    './files', './images/membersprofilepic', './pics', './temporary',
                    './backup', '.htaccess', './administrator/.htaccess', './include/config.php']
            }
        }
    });

    grunt.loadNpmTasks('grunt-ftp-deploy');
    grunt.registerTask('stg-deploy',['ftp-deploy']);

};