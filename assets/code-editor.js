'use strict';
(function($){
    $(function(){

        if( $("#js-code-editor-scn-header").length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 2,
                    tabSize: 2,
                    mode: 'javascript',
                }
            );
            var editor = wp.codeEditor.initialize( $("#js-code-editor-scn-header"), editorSettings );
        }

        if( $("#js-code-editor-scn-footer").length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 2,
                    tabSize: 2,
                    mode: 'javascript',
                }
            );
            var editor = wp.codeEditor.initialize( $("#js-code-editor-scn-footer"), editorSettings );
        }

        if( $("#js-code-editor-scn-config").length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 2,
                    tabSize: 2,
                    mode: 'javascript',
                }
            );
            var editor = wp.codeEditor.initialize( $("#js-code-editor-scn-config"), editorSettings );
        }

    });
})(jQuery);
