

function HandleBack(){
	var curURL = window.location.href;
	var fileOnly = curURL.replace('http://www.cgoefron.com/Game/','');
	fileOnly = fileOnly.replace('http://localhost:8888/Game/','');

	console.log(curURL);
	console.log(fileOnly);

	// if (document.images) {
	// 	window.location.replace(curURL);
	// }
	// else {
	// 	window.location.href = fileOnly;
	// }

	

	if(window.event){
		//alert("Cannot click back button!"); 
		console.log("HandleBack");
			if (document.images) {

			window.location.replace(curURL);
		}
			else {
			window.location.href = fileOnly;
		}
	} else {
		console.log("HandleBack2");
			if (document.images) {
		window.location.replace(curURL);
			}
			else {
			window.location.href = fileOnly;
		}
	}
}
