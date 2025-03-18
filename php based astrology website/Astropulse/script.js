document.querySelector("form").addEventListener("submit", function(event) {
  event.preventDefault();
  var name = document.querySelector("input[name='name']").value.trim();
  var email = document.querySelector("input[name='email']").value.trim();
  var message = document.querySelector("textarea[name='text']").value.trim();

  // Regular expression for email validation
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (name === "" || email === "" || message === "") {
    alert("Please fill in all fields.");
    return;
  }

  if (!emailRegex.test(email)) {
    alert("Please enter a valid email address.");
    return;
  }

  // If all validation passes, submit the form
  this.submit();
  
  // Alert for successful submission
  alert("Form submitted successfully!");
});

  