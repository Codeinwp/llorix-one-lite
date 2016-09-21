/* jshint node:true */
// https://github.com/tomusdrw/grunt-sync
module.exports = {
    syncLite: {
        files: [{
            // cwd: '*',
            src: [
                /* Include Everything */
                '**',

                /* Exclude Utilities */
                '!node_modules/**',
                '!grunt/**',
                '!logs/**',
                '!.idea/**',
                '!package.json',
                '!Gruntfile.js',
                '!.gitignore',
                '!.jshintrc',
                '!phpcs.xml',

                /* Exclude pro features */
                '!inc/features/**',
                '!template-parts/footer-content.php',
                '!template-parts/palette-content.php',
                '!template-parts/ribbon-content.php',

                /* Exclude Plus Exclusive Templates from Lite Version*/
                '!page-templates/template-about-us.php',
                '!page-templates/template-homepage-two.php'
            ],
            dest: '../<%= pkg.name %>-lite/'
        }],
        updateAndDelete: true,
        failOnError: true,
        verbose: true // Display log messages when copying files
    }
};