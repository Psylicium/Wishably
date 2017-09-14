function countdown() {
	var i = document.getElementById('counter');
	i.innerHTML = parseInt(i.innerHTML)-1;
}
setInterval(function(){ countdown(); },1000);