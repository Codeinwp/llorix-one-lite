/* jshint node:true */
// https://github.com/blazersix/grunt-wp-i18n
module.exports = {
    main: {
        options: {
            textdomain: '<%= pkg.theme.textdomain %>',
        },
        theme: {
            files: {
                src: [
                    '<%= files.php %>'
                ],
            },
        },
    },
    lite: {
        options: {
            textdomain: '<%= pkg.theme.textdomain %>-lite',
            updateDomains: ['<%= pkg.theme.textdomain %>'],

        },
        files: {
            src: [
                '../<%= pkg.theme.textdomain %>-lite/**/*.php'
            ]
        }
   }
};


