//window.addEventListener("DOMContentLoaded", function() {
	
	
function hasGetUserMedia() {
  return !!(navigator.getUserMedia || navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia || navigator.msGetUserMedia);
}

if (hasGetUserMedia()) {
  // Good to go!
} else {
  alert('getUserMedia() is not supported in your browser');
}




		// var canvas = document.getElementById("canvas"),
		// 	context = canvas.getContext("2d"),
		// 	video = document.getElementById("video"),
		// 	videoObj = { "video": true },
		// 	errBack = function(error) {
		// 		console.log("Video capture error: ", error.code); 
		// 	};

		// // video listeners
		// if(navigator.getUserMedia) { // Standard
		// 	navigator.getUserMedia(videoObj, function(stream) {
		// 		video.src = stream;
		// 		video.play();
		// 	}, errBack);
		// } else if(navigator.webkitGetUserMedia) { 
		// 	navigator.webkitGetUserMedia(videoObj, function(stream){
		// 		video.src = window.webkitURL.createObjectURL(stream);
		// 		video.play();
		// 	}, errBack);
		// }
		// else if(navigator.mozGetUserMedia) { // Firefox
		// 	navigator.mozGetUserMedia(videoObj, function(stream){
		// 		video.src = window.URL.createObjectURL(stream);
		// 		video.play();
		//}, errBack);
	//}
//}, false);