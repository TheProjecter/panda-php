if (typeof panda === 'undefined' || !panda.http) {
	throw "Unable to create service: panda.http is not loaded.";
}

NAME = function () {
	var sendRequest = function (name, params) {
		console.log('Calling: ' + name + '(' + params + ');');
	};

	return {/* Service Definition */};
}();