(function () {
  "use strict";

  function hidePreloader() {
    var wrapper = document.querySelector(".loader-wrapper");
    if (!wrapper) return;
    wrapper.classList.add("is-hidden");
    window.setTimeout(function () {
      if (wrapper.parentNode) wrapper.parentNode.removeChild(wrapper);
    }, 450);
  }

  function initializeParticles() {
    var particles = document.getElementById("particles");
    if (particles && typeof window.particleground === "function") {
      window.particleground(particles, {
        dotColor: "#e6ebf3",
        lineColor: "#e6ebf3"
      });
    }
  }

  function announceResult() {
    if (typeof window.confirmation !== "object" || !window.confirmation.type) return;

    var notice = document.createElement("div");
    notice.className = "domina-notice domina-notice--" + (window.confirmation.type === "success" ? "success" : "error");
    notice.setAttribute("role", window.confirmation.type === "success" ? "status" : "alert");
    notice.setAttribute("aria-live", "polite");

    var content = document.createElement("div");
    content.className = "domina-notice__content";

    var title = document.createElement("strong");
    title.className = "domina-notice__title";
    title.textContent = window.confirmation.title || "";

    var description = document.createElement("span");
    description.className = "domina-notice__description";
    description.textContent = window.confirmation.description || "";

    var close = document.createElement("button");
    close.type = "button";
    close.className = "domina-notice__close";
    close.setAttribute("aria-label", "بستن پیام");
    close.textContent = "×";
    close.addEventListener("click", function () {
      notice.remove();
    });

    content.appendChild(title);
    content.appendChild(description);
    notice.appendChild(content);
    notice.appendChild(close);
    document.body.appendChild(notice);

    window.setTimeout(function () {
      notice.classList.add("is-visible");
    }, 30);

    if (window.confirmation.type === "success") {
      window.setTimeout(function () {
        notice.classList.remove("is-visible");
        window.setTimeout(function () { notice.remove(); }, 300);
      }, 5000);
    }
  }

  document.addEventListener("DOMContentLoaded", function () {
    initializeParticles();
    announceResult();
  });

  window.addEventListener("load", hidePreloader);
  window.setTimeout(hidePreloader, 4000);
})();
