document.addEventListener("DOMContentLoaded", function () {
  // Auto scroll ke hasil setelah submit
  const resultSection = document.querySelector(".card.border-primary");
  if (resultSection) {
    resultSection.scrollIntoView({
      behavior: "smooth",
      block: "start",
      inline: "nearest",
    });
  }
});
