

// Get the button
let mybutton = document.getElementById("scrollBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
	scrollFunction()
};

function scrollFunction() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
	var distanceScrolled = document.documentElement.scrollTop;
	var topbar = document.getElementById("topbar");
	var mobileMenu = document.getElementById("m-menu");

	// if(distanceScrolled == 0){
	// 	topbar.classList.remove("fixed-top");
	// 	mobileMenu.classList.remove("mfixed-top");
	// }else{
	// 	if(!topbar.classList.contains("fixed-top")){
	// 		topbar.classList.add("fixed-top");
	// 	}
	// 	if(!mobileMenu.classList.contains("mfixed-top")){
	// 		mobileMenu.classList.add("mfixed-top");
	// 	}
	// }

	// if(distanceScrolled > 100){
	// 	if(!topbar.classList.contains("fixed-top")){
	// 		topbar.classList.add("fixed-top");
	// 	}
	// 	if(!mobileMenu.classList.contains("mfixed-top")){
	// 		mobileMenu.classList.add("mfixed-top");
	// 	}
	// }else if(distanceScrolled == 0){
	// 	topbar.classList.remove("fixed-top");
	// 	mobileMenu.classList.remove("mfixed-top");
	// }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}




