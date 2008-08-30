if (typeof panda === 'undefined' || !panda.http) {
	throw "Unable to create service: panda.http is not loaded.";
}

%s = function () {
	var sendRequest = function (name, params) {
		var data = {
			'service' : '%s'
		};

		for (var i = 0; i < params.length; i++) {
			data['param[' + i +']'] = params[i];
		}

		return panda.http.get(%s.endpoint, {'data':data});
	};

	return {
		%s
	};
}();