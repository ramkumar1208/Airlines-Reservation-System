function check() {
  var checkedBoxes = [];
  var inputElements = document.getElementsByTagName("input");

  for (var i = 0; i < inputElements.length; i++) {
    if (inputs[i].type === "checkbox") {
      // do something with the checkbox
      for (var i = 0; i < inputElements.length; i++) {
        if (
          inputElements[i].type === "checkbox" &&
          inputElements[i].checked === true
        )
          checkedBoxes.push(inputElements[i].id);
      }
    }
  }
  alert(checkedBoxes);
}

function showSelected() {
  var checkboxes = document.querySelectorAll("input[type=checkbox]:checked");
  var values = [];
  for (var i = 0; i < checkboxes.length; i++) {
    values.push(checkboxes[i].id);
  }
  alert("Selected seats: " + values.join(", "));
}
