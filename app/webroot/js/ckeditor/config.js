/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	
	config.toolbar = 'Full';
 
 	
 	
 	config.extraPlugins = 'pastefromword,colorbutton';
 	config.pasteFromWordRemoveFontStyles = false;
 	config.pasteFromWordRemoveStyles = false;
	
	
	;


	config.colorButton_colors = 
	
	'000,800000,8B4513,2F4F4F,008080,000080,4B0082,696969,' +
	'c1a876,2d2d29,DAA520,006400,40E0D0,0000CD,800080,808080' +
	'B22222,A52A2A,DAA520,006400,40E0D0,0000CD,800080,808080,' +
	'F00,FF8C00,FFD700,008000,0FF,00F,EE82EE,A9A9A9,' +
	'FFA07A,FFA500,FFFF00,00FF00,AFEEEE,ADD8E6,DDA0DD,D3D3D3,' +
	'FFF0F5,FAEBD7,FFFFE0,F0FFF0,F0FFFF,F0F8FF,E6E6FA,FFF';

//  
 // [
	// { name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
	// { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
	// { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
	// // { name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 
        // // 'HiddenField' ] },
	// '/',
	// { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
	// { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
	// '-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
	// { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
	// { name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
	// '/',
	// { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
	// { name: 'colors', items : [ 'TextColor','BGColor' ] },
	// { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
// ];
	
	
	
config.toolbar_Full =
[
	{ name: 'document', items : [ 'Source','-','NewPage','DocProps','-','Templates' ] },
	{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
	{ name: 'editing', items : [ 'Find','Replace','-','SelectAll' ] },
	
	{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
	
	{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
	
	{ name: 'colors', items : [ 'TextColor','BGColor' ] },
	{ name: 'tools', items : [ 'Maximize' ] },
	
	{ name: 'insert', items : [ 'Image','Table','SpecialChar' ] },
	{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
	'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
	
	
	{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] }
	
];
	
	
	
	
	CKEDITOR.config.format_tags = 'H6_Title;Statistics;watch_video;panel_heading;call_us_now;border_bottom;Note;div';
	config.format_Note = { element : 'span', name: 'Note', attributes : { 'class' : 'contentTitle5' } };
	
	config.format_H6_Title = { element : 'h6', name: 'H6 Title', attributes : { 'class' : 'bluePageTitle' } };
	config.format_Statistics = { element : 'div', name: 'Statistics Title', attributes : { 'class' : 'pageTextInsideTitleStatistic' } };
	config.format_watch_video = { element : 'div', name: 'Watch Video Title', attributes : { 'class' : 'pageTextInsideTitlevideo' } };
	
	config.format_panel_heading= { element : 'div', name: 'Accordion Title', attributes : { 'class' : 'panel_heading' } };
	config.format_border_bottom = { element : 'div', name: 'Bottom Boarder', attributes : { 'class' : 'boarder_bottom' } };
	config.format_call_us_now = { element : 'a', name: 'Call us Now', attributes : { 'class' : 'call_us_now' } };
	
	
	
	
//	config.enterMode = 2;
	config.enterMode = CKEDITOR.ENTER_BR;
	
	
	
	
	
	// config.toolbarGroups = [
    // { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
    // { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
    // { name: 'links' },
    // { name: 'insert' },
    // { name: 'forms' },
    // { name: 'tools' },
    // { name: 'document',    groups: [ 'mode', 'document', 'doctools' ] },
    // { name: 'others' },
    // '/',
    // { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
    // { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },
    // { name: 'styles' },
    // { name: 'colors' },
    // { name: 'about' }
// ];



};
