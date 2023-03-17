let counter = 0;
let timer, sliderItems, slides, slideWidth;

window.onload = () => {
  const containerSlider = document.querySelector(".container-slider");
  const sliderItems = document.querySelector(".slider-items");
  const sliderItem = document.querySelector(".slider-item");

  let firstPicture = sliderItems.firstElementChild.cloneNode(true);
  sliderItems.appendChild(firstPicture);

  slides = Array.from(sliderItems.children);

  slideWidth = sliderItem.getBoundingClientRect().width;
  console.log(slideWidth);

  let next = document.querySelector("#nav-right");
  let prev = document.querySelector("#nav-left");

  next.addEventListener("click", slideNext);
  prev.addEventListener("click", slidePrev);

  timer = setInterval(slideNext, 3500);

  containerSlider.addEventListener("mouseover", () => {
    stopTimer();
  });
  containerSlider.addEventListener("mouseout", () => {
    startTimer();
  });

  function slideNext() {
    counter++;
    sliderItems.style.transition = "1s linear";

    let decal = -slideWidth * counter;
    sliderItems.style.transform = `translateX(${decal}px)`;

    setTimeout(function () {
      if (counter >= slides.length - 1) {
        counter = 0;
        sliderItems.style.transition = "unset";
        sliderItems.style.transform = "translateX(0)";
      }
    }, 1000);
  }

  function slidePrev() {
    // On décrémente le compteur
    counter--;
    sliderItems.style.transition = "700ms linear";

    if (counter < 0) {
      counter = slides.length - 1;
      let decal = -slideWidth * counter;
      sliderItems.style.transition = "unset";
      sliderItems.style.transform = `translateX(${decal}px)`;
      setTimeout(slidePrev, 1);
    }

    let decal = -slideWidth * counter;
    sliderItems.style.transform = `translateX(${decal}px)`;
  }

  function stopTimer() {
    clearInterval(timer);
  }

  function startTimer() {
    timer = setInterval(slideNext, 2000);
  }
};
