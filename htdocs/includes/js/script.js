/*navbar shrink*/
window.addEventListener("scroll", shrink_Navbar, false);
var lastScrollTop = window.pageYOffset || document.documentElement.scrollTop;
function shrink_Navbar() { 
	var st = window.pageYOffset || document.documentElement.scrollTop; 

	if (st > lastScrollTop){
		document.getElementById("navbar").classList.add("hide");
		document.getElementById("subnav").classList.add("small");
	} else {
		document.getElementById("navbar").classList.remove("hide");
		document.getElementById("subnav").classList.remove("small");
	}

	lastScrollTop = st;
}



/*index sidenav*/
// var onOff = false;

function toggleSidenav() {
	document.getElementById("sidenav").classList.toggle("open");
	document.getElementById("sidenavToggle").classList.toggle("active");
}






/*sidenav*/
var innerSideNav = document.getElementsByClassName("inner");

function openInnerSideNav(id) {
	var targetDivSrc = "innerSideNav" + id;
	var targetDiv = document.getElementById(targetDivSrc);

	for (var i = 0; i < innerSideNav.length; i++) {
		innerSideNav[i].className = innerSideNav[i].className.replace(" active", "");
	}

	targetDiv.classList.add("active");
}






/*pass option value realtime*/
function passValue() {
	var source = document.getElementById("addressID").value;
	document.getElementById("addressInput").value = source;
}






/*image modal*/
var modal = document.getElementById("modal");

function openModal(id) {
	var imgSrc = "imageToModal" + id;
	var image = document.getElementById(imgSrc);

	modal.style.display = "block";
	document.getElementById("imageInModal").src = image.src;
	console.log(imgSrc);
}

var closeBtn = document.getElementById("closeBtn");

closeBtn.onclick = function() {
	modal.style.display = "none";
}






/*carousel*/
var contentIndex = 1;
showContent(contentIndex);

function changeContent(index) {
	showContent(contentIndex += index);	
}

function currentContent(index) {
	showContent(contentIndex = index);
}

function showContent(index) {
	var content = document.getElementById("content").getElementsByClassName("card");
	var indicator = document.getElementById("indicator").getElementsByClassName("indicator");
	

	if (index > content.length) {
		contentIndex = 1;
	}
	if (index < 1) {
		contentIndex = content.length;
	}

	for (var i = 0; i < content.length; i++) {
		content[i].className = content[i].className.replace(" active", "");
	}

	for (var i = 0; i < indicator.length; i++) {
		indicator[i].className = indicator[i].className.replace(" active", "");
	}

	content[contentIndex - 1].className += " active";
	indicator[contentIndex - 1].className += " active";
}





