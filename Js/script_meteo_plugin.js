

alert("Salut, ça marche bien!");
// var ajax = new XMLHttpRequest();
// ajax.onreadystatechange = function () {
//     if (this.readyState == 4) {
//         alert('Réponse de la requête AJAX : ' + this.response);
//     }
// };
// ajax.open('POST', 'ajax.php', true);
// ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
// ajax.send('pass=1formatik');



// function showDepartmentList() {
//     document.getElementById("lesdepartements").innerHTML = "";
//     if (region.value != "") {
//         departement.style = "display:block!important";

//         let xmlhttp = new XMLHttpRequest();
//         xmlhttp.onreadystatechange = function () {
//             if (this.readyState == 4 && this.status == 200) {
//                 var departements = JSON.parse(this.response);
//                 console.log(departements)
//                 document.getElementById("lesdepartements").innerHTML += '<option value="">Selecionnez une région</option>'
//                 for (let i = 0; i < departements.length; i++) {
//                     document.getElementById("lesdepartements").innerHTML += '<option value="' + departements[i].nom_departement + '">' + departements[i].nom_departement + '</option>'
//                 }
//             }
//         }
//         xmlhttp.open("GET", "search.php?region=" + region.value)
//         xmlhttp.send()
//     } else {
//         departement.style = "display:none!important"
//     }

// }