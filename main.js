var rotateStatus = 1;

function rotateMenuIcon() {
	var rotateIcon = document.getElementById("menu-icon");
	var slideBar = document.getElementById("sidebar");
	var slideContent = document.getElementById("content");

	if (rotateStatus === 1) {
		rotateStatus = 0;
		rotateIcon.style.transform = "rotate(-90deg)";
		slideBar.style.width = "0%";
		slideContent.style.width = "100%";
	}
	else {
		rotateStatus = 1;
		rotateIcon.style.transform = "rotate(0deg)";
		slideBar.style.width = "18%";
		slideContent.style.width = "82%";
	}
}