document.addEventListener("DOMContentLoaded", () => {
  // --- Contact Form ---
  const contactForm = document.querySelector("form#contactForm, .space-y-4"); 
  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const name = document.getElementById("name")?.value || "Anonymous";
      const email = document.getElementById("email")?.value || "Not provided";
      const message = document.getElementById("message")?.value || "";

      if (!message.trim()) {
        alert("Please enter a message before sending.");
        return;
      }

      alert(`✅ Message sent!\nName: ${name}\nEmail: ${email}\nMessage: ${message}`);
      contactForm.reset();
    });
  }

  // --- Report Issue Form ---
  const reportForm = document.getElementById("reportForm");
  if (reportForm) {
    reportForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const category = document.getElementById("category")?.value || "Unspecified";
      const details = document.getElementById("details")?.value || "";
      const name = document.getElementById("name")?.value || "Anonymous";

      if (!details.trim()) {
        alert("Please describe the issue before submitting.");
        return;
      }

      alert(`✅ Report submitted!\nCategory: ${category}\nDetails: ${details}\nName: ${name}`);
      reportForm.reset();
    });
  }
});
