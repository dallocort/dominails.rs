window.addEventListener("load", () => {
  document.getElementById("forma").addEventListener("submit", posaljiMail);
});
function posaljiMail(e) {
  e.preventDefault();
  let name = document.getElementById("name");
  let email = document.getElementById("email");
  let message = document.getElementById("message");
  let forma = document.getElementById("forma");
  let button = document.getElementsByTagName("button");
  let spanName = name.previousElementSibling;
  let spanPosetilac = email.previousElementSibling;
  let spanMessage = message.previousElementSibling;
  let http = new XMLHttpRequest();
  http.open(
    "GET",
    `process.php?ime_prezime=${name.value}&email=${email.value}&poruka=${
      message.value
    }`,
    true
  );
  http.onload = () => {
    if (http.status === 200) {
      let rez = JSON.parse(http.responseText);
      if (rez.nameError) {
        spanName.classList.add("error");
        spanName.innerHTML = rez.nameError;
      } else {
        spanName.classList.remove("error");
        spanName.innerHTML = "";
      }
      if (rez.messageError) {
        spanMessage.classList.add("error");
        spanMessage.innerHTML = rez.messageError;
      } else {
        spanMessage.classList.remove("error");
        spanMessage.innerHTML = "";
      }
      if (rez.posetilacError) {
        spanPosetilac.classList.add("error");
        spanPosetilac.innerHTML = rez.posetilacError;
      } else {
        spanPosetilac.classList.remove("error");
        spanPosetilac.innerHTML = "";
      }
      if (rez.hvala) {
        forma.nextElementSibling.classList.add("hvala");
        forma.nextElementSibling.firstElementChild.innerHTML = rez.posetilac;
        //brisati sve iz inputbox kad je mail uspešno poslat
        name.value = "";
        email.value = "";
        message.value = "";
        //iz nekog razloga ostane focus na buttonu pa to skidam
        button[0].blur();
      } else {
        forma.nextElementSibling.classList.remove("hvala");
        //iz nekog razloga ostane focus na buttonu pa to skidam
        button[0].blur();
      }
    }
  };
  http.send();
}
