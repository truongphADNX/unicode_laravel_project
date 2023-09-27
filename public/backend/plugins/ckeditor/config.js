/**
 * @license Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    // config.language = 'en';
    // config.uiColor = "#EDA5DE";
    config.filebrowserImageBrowseUrl = "/laravel-filemanager?type=Images";
    config.filebrowserImageUploadUrl =
        "/laravel-filemanager/upload?type=Images&_token=" +
        $("meta[name=csrf-token]").attr("image");
    config.filebrowserBrowseUrl = "/laravel-filemanager?type=Files";
    config.filebrowserUploadUrl =
        "/laravel-filemanager/upload?type=Files&_token=" +
        $("meta[name=csrf-token]").attr("file");
};
