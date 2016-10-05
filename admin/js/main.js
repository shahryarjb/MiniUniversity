
/*
 * jQuery File Upload Plugin JS Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

/* global $, window */
//========================= //new
JQ = jQuery;   
comName = 'com_miniuniversity'  // component name
folderName = 'miniuni'  // folder name
//========================= //new

JQ(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    JQ('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url:   baseUrl + '/media/'+ comName +'/students_profile/server/php/' //new
        //url:   'students_profile/server/php'
    });

    // Enable iframe cross-domain access via redirect option:
    JQ('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

    if (window.location.hostname === 'blueimp.github.io') {
        // Demo settings:
        JQ('#fileupload').fileupload('option', {
            url: '//jquery-file-upload.appspot.com/',
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
            maxFileSize: 999000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
        });
        // Upload server status check for browsers with CORS support:
        if (JQ.support.cors) {
            JQ.ajax({
                url: '//jquery-file-upload.appspot.com/',
                type: 'HEAD'
            }).fail(function () {
                JQ('<div class="alert alert-danger"/>')
                    .text('Upload server currently unavailable - ' +
                            new Date())
                    .appendTo('#fileupload');
            });
        }
    } else {
        // Load existing files:
        JQ('#fileupload').addClass('fileupload-processing');
        JQ.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: JQ('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: JQ('#fileupload')[0]
        }).always(function () {
            JQ(this).removeClass('fileupload-processing');
        }).done(function (result) {
            JQ(this).fileupload('option', 'done')
                .call(this, JQ.Event('done'), {result: result});
        });
    }

});
