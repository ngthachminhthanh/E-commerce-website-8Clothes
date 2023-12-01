
        $(document).ready(function () {
  var themeToggleDarkIcon = $("#theme-toggle-dark-icon");
  var themeToggleLightIcon = $("#theme-toggle-light-icon");
  var themeToggleBtn = $("#theme-toggle");

  function setInitialTheme() {
    var currentTheme = localStorage.getItem("color-theme");

    if (currentTheme === "dark" || (!currentTheme && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
      $("html").addClass("dark");
      themeToggleLightIcon.removeClass("hidden");
    } else {
      themeToggleDarkIcon.removeClass("hidden");
    }
  }

  setInitialTheme();

  function toggleTheme() {
    themeToggleDarkIcon.toggleClass("hidden");
    themeToggleLightIcon.toggleClass("hidden");

    var currentTheme = localStorage.getItem("color-theme");

    if (currentTheme === "light") {
      $("html").addClass("dark");
      localStorage.setItem("color-theme", "dark");
    } else {
      $("html").removeClass("dark");
      localStorage.setItem("color-theme", "light");
    }
  }

  themeToggleBtn.on("click", toggleTheme);
});