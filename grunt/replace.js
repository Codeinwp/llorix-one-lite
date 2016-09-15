/* jshint node:true */
// https://github.com/outaTiME/grunt-replace
module.exports = {

   liteRename: {
       src: [
           '../<%=pkg.name%>-lite/style.css'
       ],
       overwrite: true,
       replacements: [{
           from: /TheMotion/g,
           to: 'TheMotion Lite'
       }]
    }
};
