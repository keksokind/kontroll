function filterFunction() {
  var input, filter, a, i;
  input = document.getElementById("rname");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");

  if (filter === "") {
      div.style.display = "none";
      return;
    }
  
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
  div.style.display = "block";
}
var dropdownItems = document.querySelectorAll("#myDropdown a");
dropdownItems.forEach(function (item) {
  item.addEventListener("click", function () {
      document.getElementById("rname").value = this.textContent;
      document.getElementById("myDropdown").style.display = "none";
  });
});