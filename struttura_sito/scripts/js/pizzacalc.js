//Codice di prova da modificare
function calcola() {
  var n_p = document.getElementById("numero_p").value;
  var p_style = document.getElementById("stile_p").value;
  var idd = document.getElementById("idratazione").value;
  var dp_p = document.getElementById("diametro_p").value;
  teglia(p_style);

  var farina = (5 * dp_p);
  document.getElementById("res_far").innerHTML = n_p * (5 * dp_p);
  document.getElementById("res_h2o").innerHTML = (n_p * farina) * (idd / 100);
  document.getElementById("res_lie").innerHTML = ((n_p * farina) * 1) / 100;
  document.getElementById("res_sal").innerHTML = ((n_p * farina) * 2) / 100;
  document.getElementById("res_oli").innerHTML = ((n_p * farina) * 5) / 100;
}

function teglia(style) {
  if (style == "Pizza in teglia") {
    document.getElementById("label_diametro").innerHTML = "Profondità teglia (cm)";
    label_larghezza.style.display = "block";
    larghezza.style.display = "block";
  } else {
    document.getElementById("label_diametro").innerHTML = "Diametro pizza (cm)";
    label_larghezza.style.display = "none";
    larghezza.style.display = "none";

  }
}
