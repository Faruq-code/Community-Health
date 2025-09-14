document.addEventListener("DOMContentLoaded", () => {
  // ========================
  // Contact Form Validation
  // ========================
  let contactForm = document.getElementById("contactForm");
  if (contactForm) {
    contactForm.addEventListener("submit", function(event) {
      let name = document.getElementById("name").value.trim();
      let email = document.getElementById("email").value.trim();
      let message = document.getElementById("message").value.trim();

      if (name === "" || email === "" || message === "") {
        alert("⚠️ Please fill in all contact fields.");
        event.preventDefault();
        return;
      }

      // Simple email format check
      if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) {
        alert("⚠️ Please enter a valid email address.");
        event.preventDefault();
        return;
      }

      alert("✅ Message sent successfully!");
    });
  }

  // ========================
  // Report Issue Validation
  // ========================
  let reportForm = document.getElementById("reportForm");
  if (reportForm) {
    reportForm.addEventListener("submit", function(event) {
      let category = document.getElementById("category").value.trim();
      let details = document.getElementById("details").value.trim();

      if (category === "" || details === "") {
        alert("⚠️ Please select a category and describe the issue.");
        event.preventDefault();
        return;
      }

      // File validation
      let files = document.getElementById("evidence").files;
      for (let file of files) {
        if (file.size > 5 * 1024 * 1024) { // 5MB per file
          alert("⚠️ Each file must be less than 5MB.");
          event.preventDefault();
          return;
        }
      }

      alert("✅ Report submitted successfully!");
    });
  }
});
