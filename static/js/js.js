var Home = {

	sendForm : function(event, url) {

		event.preventDefault();

		var p_data = $('.form_sdv').serialize();

	    $.ajax({
	        url :  url,
	        type: 'POST',
	        data: p_data,
			xhr: function() {
				var xhr = new window.XMLHttpRequest();
				return xhr;
			},
			beforeSend: function() {
				$("#rsp-empleado").html();
				$("#rsp-empleado").html('<center><img src="../nexura/static/images/loading.gif" /></center>');
			},
			uploadProgress: function(event, position, total, percentComplete) {
			},
			success: function() {
			},
			complete: function(xhr) {
				var response = xhr.responseText.trim();
				$("#rsp-empleado").empty();
				if( response == 1 ) {
					$("#rsp-empleado").html("<div class='exito'>Se ha creado el empleado con éxito</div>");
					setTimeout(function(){location.reload(true);},3000);
					$("#frm-empleado")[0].reset();
				}

				if( response == 2 ) {
					$("#rsp-empleado").html("<div class='exito'>Se ha creado el empleado con éxito</div>");
					setTimeout(function(){location.reload(true);},3000);
				}

				if( response == 3 ) {
					$("#rsp-empleado").html("<div class='error'>Debes ingresar los campos obligatorios</div>");
					setTimeout(function(){location.reload(true);},3000);
				}

				if( response == 4 ) {
					$("#rsp-empleado").html("<div class='error'>Error</div>");
					setTimeout(function(){location.reload(true);},3000);
				}

				if( response == 5 ) {
					$("#rsp-empleado").html("<div class='error'>Error al digitar el email</div>");
					setTimeout(function(){location.reload(true);},3000);
				}
			}
	    });
	},

	delete : function(id) {

		event.preventDefault();

		var p_data = {
			id: id,
			table: 'empleados'
		};

	    $.ajax({
	        url :  "functions/delete.php",
	        type: 'POST',
	        data: p_data,
			xhr: function() {
				var xhr = new window.XMLHttpRequest();
				return xhr;
			},
			beforeSend: function() {
				$("#rsp-empleados").empty();
				$("#rsp-empleados").html('<center><img src="../nexura/static/images/loading.gif" /></center>');
			},
			uploadProgress: function(event, position, total, percentComplete) {
			},
			success: function() {
			},
			complete: function(xhr) {
				var response = xhr.responseText.trim();
				$("#rsp-empleado").empty();

				if( response == 6 ) {
					$("#rsp-empleado").html("<div class='exito'>Se ha creado el empleado con éxito</div>");
					$("#rsp-empleado").append(setTimeout(function(){location.reload(true);},3000));
				}
			}
	    });
	}

};