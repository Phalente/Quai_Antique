let datePicker = document.getElementById("reservation_Date");
if (datePicker !== null) {
  datePicker.addEventListener("change", function () {
    this.setAttribute("value", this.value);
    let form = this.closest("form");
    let selectdDate = new Date(this.value);
    console.log(selectdDate);
    let formattedDate = selectdDate.toLocaleDateString("fr-FR", {
      year: "numeric",
      month: "2-digit",
      day: "2-digit",
    });
    console.log(formattedDate);

    let data =
      this.name + "=" + this.value + "&formatted_date=" + formattedDate;

    fetch(form.action, {
      method: form.getAttribute("method"),
      body: data,
      headers: {
        "Content-Type":
          "application/x-www-form-urlencoded;         charset:utf8",
      },
    })
      .then((response) => response.text())
      .then((html) => {
        let content = document.createElement("html");
        content.innerHTML = html;
        let newSelect = content.querySelector("#reservation_time_slot");
        console.log(newSelect);
        console.log(document.getElementById("reservation_time_slot"));
        document.getElementById("reservation_time_slot").replaceWith(newSelect);
      });
  });
}
