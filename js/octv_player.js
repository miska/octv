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
		update_player_info();
	}).fail(function (response, code) {
		OC.Notification.showTemporary('ERROR: Something went wrong while trying to play file "' + filename + '"');
	});
}

function delete_video(dirname, filename) {
	var baseUrl = OC.generateUrl('/apps/files');
	var my_post = { 'dir': dirname,
			'files': JSON.stringify( [ filename ] ) };
	OC.Notification.showTemporary('Deleting "' + filename + '"');
	$.ajax({
		url: baseUrl + '/ajax/delete.php',
		type: 'POST',
		data: my_post
	}).done(function (response) {
		OC.Notification.showTemporary('File "' + filename + '" deleted...');
		var my_get = { 'dir': dirname,
				'force': 'true' };
		OC.Notification.showTemporary('Refreshing, please wait...');
		$.ajax({
			url: baseUrl + '/ajax/scan.php',
			type: 'GET',
			data: my_get
		}).done(function (response) {
			location.reload();
		});
	}).fail(function (response, code) {
		OC.Notification.showTemporary('ERROR: Something went wrong while trying to delete file "' + filename + '"');
	});
}

function to_hour_mins(seconds) {
	var hours = Math.floor(seconds / 3600);
	var minutes = Math.floor(seconds / 60) - hours * 60;
	return '' + hours + ':' + (minutes < 10 ? '0' + minutes : minutes);
}

function update_player_info() {
	var baseUrl = OC.generateUrl('/apps/octv');
	var my_post = { request: 'info' };

	$.ajax({
		url: baseUrl + '/controls/command',
		type: 'POST',
		contentType: 'application/json',
		data: JSON.stringify(my_post)
	}).done(function (response) {
		if(response && response.status == 'playing') {
			$('#octv-now').text(response.filename);
			$('#octv-total').text(to_hour_mins(response.total));
			$('#octv-current').text(to_hour_mins(response.current));
			$('#octv-status').show();
		} else {
			$('#octv-status').hide();
		}
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
		update_player_info();
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
        $('.octv-delete').click(function() {
                delete_video($(this).data('dir'), $(this).data('name'));
        });
        $('.octv-control').click(function() {
                player_command($(this).data('command'));
        });
	if($('#octv-status').length) {
		update_player_info();
		setInterval(update_player_info,20000);
	}
});
