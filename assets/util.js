const subpages = ['home'];

function clearChildren(parent){
	while(parent.firstChild) {
		parent.removeChild(parent.firstChild);
	}
}

function niceDate(date){
	if(!(date instanceof Date)){
		return "Invalid Date";
	}

	var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	return months[date.getMonth()] + " " + date.getDate() + ", " + date.getFullYear();
}

function getPageParams(){
	let params_str = window.location.search.substr(1);
	let params = {};

	if(params_str != null && params_str != ""){
		let params_arr = params_str.split('/');
		let param_count = 0;
		let prev_param = null;

		for(let i = 0; i < params_arr.length; i++){
			if(params_arr[i] && params_arr.length > 0){
				if(param_count == 0){
					params.page = params_arr[i];
					param_count++;
				}

				if(prev_param == null){
					prev_param = params_arr[i];
				}else {
					params[prev_param] = params_arr[i];
					param_count++;
					prev_param = null;
				}
			}
		}
	}

	console.log(params);

	return params;
}

function redirect(url){
	window.location = '/?/'+url;
}

function parseBoolString(str_bool){
	if(str_bool === 'true' || str_bool === true){
		return true;
	}

	return false;
}

function gotoSubpage(subpage){
	if(!subpage){
		let params = getPageParams();

		if(params.page){
			subpage = params.page;
		}else{
			subpage = 'home';
		}
	}else{
		if(!subpages.includes(subpage)){
			throw "Invalid subpage";
		}
	}

	let subpage_script_el = document.getElementById('subpage-script');
	let subpage_content_el = document.getElementById('content');

	fetch('subpage/' + subpage + '.html').then((response) => {
		return response.text();
	}).then((response) => {
		subpage_content_el.innerHTML = response;
		subpage_script_el.src = 'script/' + subpage + '.js';
		rebindInteractionEvents();
	}).catch((err) => {
		console.log("Could not load subpage: " + err);
	});
}

function appError(message, submessage = null){
	if(submessage){
		message += ": " + submessage;
	}

	console.log(message);
}

function jkAPI(endpoint, payload = {}, use_get = false){
	return new Promise((resolve, reject) => {
		let xhr = new XMLHttpRequest();
		let type = use_get ? 'GET' : 'POST';
		let data = null;

		xhr.onload = function(e){
			if (xhr.readyState === 4) {
				if (xhr.status === 200) {
					resolve(JSON.parse(xhr.responseText));
				}else{
					reject("Bad HTTP status");
				}
			}
		};

		xhr.open(type, 'endpoint/' + endpoint, true);

		if(use_get){
			for(let i = 0; i < Object.keys(payload).length; i++){
				let key = Object.keys(payload)[i];

				if(i == 0){
					data = "?";
				}else{
					data += "&";
				}

				data += key;
				data += "=";
				data += encodeURIComponent(payload[key]);
			}
		}else{
			xhr.setRequestHeader("Content-Type", "application/json");

			if(Object.keys(payload).length > 0){
				data = JSON.stringify(payload);
			}
		}

		console.log("Contacting endpoint /" + endpoint + " with data:");
		console.log(data);
		xhr.send(data);
	});
}

function appendUpdateJSON(original, updated){
	Object.keys(updated).forEach(function(k){
		original[k] = updated[k];
	});

	return original;
}

window.onload = function(){
	// Load initial subpage
	// Null indicates "default" subpage
	gotoSubpage(null);
};