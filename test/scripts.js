// Handling the Donor page questions
let smoking = false;
let drinking = false;
let tattoos = false;

function checkSmoking(answer) {
  smoking = answer === 'yes';
  checkEligibility();
}

function checkDrinking(answer) {
  drinking = answer === 'yes';
  checkEligibility();
}

function checkTattoos(answer) {
  tattoos = answer === 'yes';
  checkEligibility();
}

function checkEligibility() {
  if (smoking || drinking || tattoos) {
    document.getElementById('message').innerText = "You cannot donate blood.";
  } else {
    document.getElementById('message').innerText = "You can donate blood.";
    document.getElementById('donor-registration').classList.remove('hidden');
  }
}

// Handling Registration Form Submissions
document.getElementById("donor-form")?.addEventListener('submit', function(event) {
  event.preventDefault();
  alert("You are registered as a donor!");
  window.location.href = "main.html"; // Redirect to the main page
});

document.getElementById("receiver-form")?.addEventListener('submit', function(event) {
  event.preventDefault();
  alert("You are registered as a receiver!");
  window.location.href = "main.html"; // Redirect to the main page
});

document.getElementById("emergency-form")?.addEventListener('submit', function(event) {
  event.preventDefault();
  alert("Emergency request submitted! You will be connected with a donor.");
  window.location.href = "main.html"; // Redirect to the main page
});

