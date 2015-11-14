function play_video(dirname, filename) {
	var baseUrl = OC.generateUrl('/apps/octv');
	var my_post = { directory: dirname,
			filename: filename };
	OC.Notification.showTemporary('Trying to play "' + filename + '"');
	$.ajax({
		url: baseUrl + '/controls/play',
		type: 'POST',
		contentType: 'application/json',
		data: JSON.stringify(my_post)
	}).done(function (response) {
		OC.Notification.showTemporary('File "' + filename + '" should be playing...');
	}).fail(function (response, code) {
		OC.Notification.showTemporary('ERROR: Something went wrong while trying to play file "' + filename + '"');
	});
}

function player_command(request) {
	var baseUrl = OC.generateUrl('/apps/octv');
	var my_post = { request: request };

	OC.Notification.showTemporary('Working on request "' + request + '"');
	$.ajax({
		url: baseUrl + '/controls/command',
		type: 'POST',
		contentType: 'application/json',
		data: JSON.stringify(my_post)
	}).done(function (response) {
		OC.Notification.showTemporary('done');
	}).fail(function (response, code) {
		OC.Notification.showTemporary('ERROR: Something went wrong while trying to process request "' + request + '"');
	});
}

$(document).ready(function() {	
	if ( typeof OCA !== 'undefined'
		&& typeof OCA.Files !== 'undefined'
		&& typeof OCA.Files.fileActions !== 'undefined'
	) {
		var mimeTypes = [
		'video/mp4',
		'video/webm',
		'video/x-flv',
		'application/ogg',
		'video/ogg',
		'video/quicktime',
		'video/x-matroska',
		'video/x-ms-asf'
		];

		var i;
		for(i = 0; i<mimeTypes.length; i++) {
			var value = mimeTypes[i];
			console.log(value);
			OCA.Files.fileActions.registerAction({
				name: 'Play',
				displayName: 'Play',
				mime: value,
				permissions: OC.PERMISSION_READ,
				type: OCA.Files.FileActions.TYPE_INLINE,
				actionHandler: function(filename, context) { play_video(context.fileList.getCurrentDirectory(), filename) }, 
				icon: OC.imagePath('core', 'actions/play')
			});
			OCA.Files.fileActions.setDefault(value, 'Play');
		}
	}
        $('.octv-video').click(function() {
                play_video($(this).data('dir'), $(this).data('name'));
        });
        $('.octv-control').click(function() {
                player_command($(this).data('command'));
        });
});
