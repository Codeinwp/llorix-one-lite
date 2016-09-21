/* jshint node:true */
// https://github.com/jgable/grunt-version
module.exports = {
        options: {
            pkg: 'myplugin.jquery.json'
        },
        myplugin: {
            options: {
                prefix: 'var version\\s+=\\s+[\'"]'
            },
            src: ['src/testing.js', 'src/123.js']
        },
        myplugin_patch: {
            options: {
                release: 'patch'
            },
            src: ['myplugin.jquery.json', 'src/testing.js', 'src/123.js'],
        }
};