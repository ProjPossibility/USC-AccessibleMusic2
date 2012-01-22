/*
* Author:      Marco Kuiper (http://www.marcofolio.net/)
*/

var currentSelection = 0;
var currentUrl = '';

google.load("jquery", "1.3.1");
google.setOnLoadCallback(function()
{
	// Register keydown events on the whole document
/*	$(document).keydown(function(e) {
		switch(e.keyCode) { 
			// User pressed "up" arrow
			case 38:
				navigate('up');
			break;
			// User pressed "down" arrow
			case 40:
				navigate('down');
			break;
			// User pressed "enter"
			case 13:
				if(currentUrl != '') {
					window.location = currentUrl;
				}
			break;
		}
	});*/
	
	// Add data to let the hover know which index they have
	for(var i = 0; i < $("#menu ul li a").size(); i++) {
		$("#menu ul li a").eq(i).data("number", i);
	}
	
	// Simulote the "hover" effect with the mouse
	$("#menu ul li a").hover(
		function () {
			currentSelection = $(this).data("number");
			setSelected(currentSelection);
		}, function() {
			$("#menu ul li a").removeClass("itemhover");
			currentUrl = '';
		}
	);
});

function navigate(direction) {
	// Check if any of the menu items is selected
	if($("#menu ul li .itemhover").size() == 0) {
		currentSelection = -1;
	}
	
	if(direction == 'up' && currentSelection != -1) {
		if(currentSelection != 0) {
			currentSelection--;
		}
	} else if (direction == 'down') {
		if(currentSelection != $("#menu ul li").size() -1) {
			currentSelection++;
		}
	}
	setSelected(currentSelection);
}

function setSelected(menuitem) {
	$("#menu ul li a").removeClass("itemhover");
	$("#menu ul li a").eq(menuitem).addClass("itemhover");
	currentUrl = $("#menu ul li a").eq(menuitem).attr("href");
}