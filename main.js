document.addEventListener("DOMContentLoaded", () => {
  // ========================
 // Handle Contact Form
// ========================
const contactForm = document.getElementById("contactForm");
if (contactForm) {
  contactForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();

    if (!name || !email || !message) {
      alert("⚠️ Please fill out all fields before submitting.");
      return;
    }

    alert("✅ Thank you! Your message has been sent.");
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
