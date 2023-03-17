const starters = document.querySelector(".starters");
const mainCourses = document.querySelector(".main-courses");
const desserts = document.querySelector(".desserts");
const drinks = document.querySelector(".drinks");
const links = [starters, mainCourses, desserts, drinks];
console.log(links);
const plats = document.querySelectorAll(".plat");

links.forEach((link) => {
  link.addEventListener("click", (event) => {
    event.preventDefault();
    const category = event.target.dataset.category;
    const filteredPlats = Array.from(
      document.querySelectorAll(`.plat[data-category="${category}"]`)
    );
    plats.forEach((plat) => {
      if (filteredPlats.includes(plat)) {
        plat.style.display = "block";
      } else {
        plat.style.display = "none";
      }
    });
  });
});
