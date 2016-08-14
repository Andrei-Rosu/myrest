var $ = require('jquery');

$('#lang').change(function () {
	window.location = window.baseURL+"?lang=" + $(this).val();
});


