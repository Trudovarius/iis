function expeditionTimer() {
	for (var i=0; i < 5; i++) {
		var sec;
		if (document.getElementById('timer-'+i+'-seconds') != null) {
			sec = document.getElementById('timer-'+i+'-seconds').textContent;
			var min = document.getElementById('timer-'+i+'-minutes').textContent;
			if (sec == null)
				break;
			if (sec <= 1 && min <= 0)
				location.reload();
			if (sec == 0) {
				sec = 60;
				document.getElementById('timer-'+i+'-minutes').innerHTML = min-1;
			}
			document.getElementById('timer-'+i+'-seconds').innerHTML = sec-1;
		}
	}
}

setInterval(expeditionTimer, 1000); 