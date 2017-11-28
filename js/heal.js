

function heal(id) {
	document.getElementById('heal-' + id).style.visibility = "visible";
}

function healHide(id) {
	document.getElementById('heal-' + id).style.visibility = "hidden";	
}

function revive(name,id) {
	if (confirm('Are you sure you want to revive ' + name + ' ?\nThis will cost 1000 food.')) {
		document.getElementById("revive-"+id).submit();
	}
}