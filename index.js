document.addEventListener("DOMContentLoaded", () => {
  const title = document.querySelector("#title");
  const avi = document.querySelector(".avi");
  let stuck = title.offsetTop;
  const copyButton = document.querySelector("#copy");
  copyButton.addEventListener("click", () =>
    copyToClipboard(document.querySelector("#email").textContent)
  );
  copyButton.addEventListener("mouseleave", () => tooltipOut());

  const arrow = document.querySelector("#scroll");
  arrow.addEventListener("click", () => scrollTo("portfolio"));

  window.onscroll = () => {
    if (window.pageYOffset >= stuck) {
      title.className = "stuck";
      avi.classList.add("stuckImg");
      avi.parentElement.classList.add("stuckDiv");
      document.querySelector("#subheading").style.display = "none";
      document.querySelector("#arrow").style.opacity = 0;
    } else if (window.pageYOffset < stuck) {
      document.querySelector("#arrow").style.opacity = 1;
      document.querySelector("#subheading").style.display = "block";
      avi.classList.remove("stuckImg");
      avi.parentElement.classList.remove("stuckDiv");
      title.className = "start";
    }
  };
});

const copyToClipboard = (element) => {
  if (!navigator.clipboard) {
    window.getSelection().removeAllRanges();
    let range = document.createRange();
    range.selectNode(element);
    window.getSelection().addRange(range);
    document.execCommand("copy");
    window.getSelection().removeAllRanges();
  } else {
    navigator.clipboard.writeText(element).then(function () {
      const tooltip = document.querySelector(".tooltiptext");
      tooltip.innerHTML = "Copied!";
      document.querySelector(".clipboard").style.color = "#d6eeed";
      document.querySelector("#copy").style.backgroundColor = "#1a2e34";
    });
  }
};

const tooltipOut = () => {
  document.querySelector(".tooltiptext").innerHTML = "Copy to clipboard";
};

const scrollTo = (place) => {
  let url = location.href;
  location.href = "#" + place;
  history.replaceState(null, null, url);
};
