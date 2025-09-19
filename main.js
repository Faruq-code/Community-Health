document.addEventListener("DOMContentLoaded", () => {
  // ========================
  // Contact Form Validation
  // ========================
  let contactForm = document.getElementById("contactForm");
  if (contactForm) {
    contactForm.addEventListener("submit", function(event) {
      event.preventDefault();

      let name = document.getElementById("name").value.trim();
      let email = document.getElementById("email").value.trim();
      let message = document.getElementById("message").value.trim();

      // Browser handles required, this is just extra safety
      if (name === "" || email === "" || message === "") {
        return;
      }

      // Simple email format check
      if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) {
        alert("⚠️ Please enter a valid email address.");
        return;
      }

      alert("✅ Message sent successfully!");
      contactForm.reset();
    });
  }

  // ========================
  // Report Issue Validation
  // ========================
  let reportForm = document.getElementById("reportForm");
  if (reportForm) {
    reportForm.addEventListener("submit", function(event) {
      event.preventDefault();

      let category = document.getElementById("category").value.trim();
      let details = document.getElementById("details").value.trim();

      // Browser handles required, this is just extra safety
      if (category === "" || details === "") {
        return;
      }

      // File validation
      let files = document.getElementById("evidence").files;
      for (let file of files) {
        if (file.size > 5 * 1024 * 1024) { // 5MB
          alert("⚠️ Each file must be less than 5MB.");
          return;
        }
      }

      alert("✅ Report submitted successfully!");
      reportForm.reset();
    });
  }
});
