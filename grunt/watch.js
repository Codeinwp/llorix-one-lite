/* jshint node:true */
// https://github.com/blazersix/grunt-contrib-watch
module.exports = {
    generateLite: {
        files: [
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
            '!.jshintrc'
        ],
        tasks: [
            'sync:syncLite',
            'newer:addtextdomain:lite'
        ]
    }
};