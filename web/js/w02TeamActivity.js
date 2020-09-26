function clicked() {
    window.alert("Clicked!")
}

// vanill JavaScript background-color change
function changeColor() {
    const color = document.getElementById("colorchange").value;
    const div = document.getElementById("div1");
    div.style.backgroundColor = color;
}

$(document).ready(function(){
    // jQuery background-color change
    $("#button2").click(function(){
      $("#div1").css({"background-color": $("#colorchange").val()});
    });
    // jQuery div fade in/out
    $("#button3").click(function(){
        $("#div3").fadeToggle("slow");
    });
  });

document.getElementById("button1").addEventListener("click", clicked);
// document.getElementById("button2").addEventListener("click", changeColor);