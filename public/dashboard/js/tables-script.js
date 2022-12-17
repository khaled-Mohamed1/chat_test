// PADDING TOP IN MOBILE
window.onload = function () {
  setTimeout(() => {
    getPaddinglocalStorage();
    window.ondeviceorientation = function () {
      getPaddinglocalStorage();
    };
    window.onresize = function () {
      getPaddinglocalStorage();
    };
  }, 100);

  document.querySelector(".loading-screen").style.display = "none";
    document.body.style.overflow = 'visible';

};
function getPaddinglocalStorage() {
  if (localStorage.getItem("body-padding-top") == "true") {
    document.body.classList.add("body-padding-top");
  } else {
    document.body.classList.remove("body-padding-top");
  }
}

function sidebarLinks(dest) {
  document.querySelector("iframe").setAttribute("src", `src/${dest}`);
  if (document.body.offsetWidth <= 767.9) {
    document.querySelector(".navbar-toggler").click();
  }
}
