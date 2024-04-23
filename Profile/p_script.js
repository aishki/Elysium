var loadFile = function (event) {
    var image = document.getElementById("output");
    var image9 = document.getElementById("output_change");
    image.src = URL.createObjectURL(event.target.files[0]);
    image9.src = URL.createObjectURL(event.target.files[0]);
  };
  
function setupEventListeners() {
  // Stage buttons
  const stageButtons = document.querySelectorAll('.p_option'); // Select all buttons with class "stage"
  const stageDivs = document.querySelectorAll('.pOptionDiv'); // Select all divs with class "stage-div"

  // Add click event listener to each stage button
  stageButtons.forEach(function(button) {
      button.addEventListener('click', function() {
          // Remove active class from all buttons
          stageButtons.forEach(function(btn) {
              btn.classList.remove('active');
          });
          // Add active class to the clicked button
          button.classList.add('active');

          // Hide all divs
          stageDivs.forEach(function(div) {
              div.style.display = 'none';
          });

          // Display the corresponding div for the clicked button
          const correspondingDivId = button.dataset.correspondingDiv; // Get the corresponding div id from data attribute
          document.getElementById(correspondingDivId).style.display = 'block';
      });
  });
}

function setDefaultActiveButton() {
  // Set "Account details" button as active by default
  const accDeet = document.querySelector('.p_option[data-corresponding-div="pOption_1"]');
  accDeet.classList.add('active');
  
  // Display the corresponding div for the active button by default
  const accDeetDiv = document.getElementById('pOption_1');
  accDeetDiv.style.display = 'block';
}

document.addEventListener("DOMContentLoaded", function() {
  setupEventListeners();
  setDefaultActiveButton();
});


