if (typeof panda === 'undefined' || !panda.http) {
	throw "Unable to create service: panda.http is not loaded.";
}

NAME = function () {
	var sendRequest = function (name, params) {
		var data = {
			'service' : 'SERVICE'
		};

		for (var i = 0; i < params.length; i++) {
			data['param[' + i +']'] = params[i];
		}

		return panda.http.get(NAME.endpoint, {'data':data});
	};

	return {/* Service Definition */};
}();