var beadid = document.getElementsByClassName("bead");
window.onload = function () {
  for (var i = 0; i < beadid.length; i++) {
      beadid[i].onclick = function () {
      var bead = window.getComputedStyle(this).getPropertyValue("float");
      console.log(bead);
       if (bead == "right") {
           this.style.cssFloat = "left";
       } else {
           this.style.cssFloat = "right";
            }

        }
    }
}
