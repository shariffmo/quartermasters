/*
	Author: Manpreet Soha
	Date: 8/2015
	StudentID: 1351289
*/
var count = 1;
var total = 7;

function photo(x) {
	
	var image = document.getElementById('image');
	count = count + x;
	if(count > total){count = 1;}
	if(count < 1){count = total;}	
	image.src = "pictures/equipmentPictures/img"+ count +".jpg";
	
}
	
window.setInterval(function photoA() {
	
	var image = document.getElementById('image');
	count = count + 1;
	if(count > total){count = 1;}
	if(count < 1){count = total;}	
	image.src = "pictures/equipmentPictures/img"+ count +".jpg";
	},3000);
	
	
