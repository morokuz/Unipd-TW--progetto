function checkStyle(){
  var numero_p = document.getElementById("numero_p").value;
  var stile_p = document.getElementById("stile_p").value;
  var idratazione = document.getElementById("idratazione").value;

  if(stile_p == "Pizza in teglia"){
          tegliaMode();
          var larghezza =document.getElementById("larghezza_p").value;
          var profondita=document.getElementById("profondita_p").value;
          var area = larghezza*profondita;
          calcolaTeglia(area, numero_p, idratazione);
      } else if(stile_p == "Napoletana"){
          napoletanaMode();
          var raggio= document.getElementById("diametro_p").value/2;
          var area= Math.pow(raggio, 2)*Math.PI;
          document.getElementById("res_far").innerHTML = 12345678;
          calcolaNapoletana(area, numero_p, idratazione);
      } else{
          tondaMode();
          var raggio= document.getElementById("diametro_p").value/2;
          var area= Math.pow(raggio, 2)*Math.PI;
          calcolaTonda(area, numero_p, idratazione);
      }
}


function calcolaNapoletana(area, numero_p, idratazione) {
  var peso = (area/6.45)*2.5;
  var farina = peso*0.65;
  var farina_b=farina/2;

  document.getElementById("res_far_b").innerHTML = (numero_p*farina_b).toFixed(0);
  var acqua = document.getElementById("res_h2o_b").innerHTML = (numero_p*farina_b*0.44).toFixed(0);
  var lievito = document.getElementById("res_lie_b").innerHTML = (numero_p*farina_b*0.01).toFixed(2);

  document.getElementById("res_far").innerHTML = (numero_p*farina_b).toFixed(0);
  document.getElementById("res_h2o").innerHTML = ((numero_p*farina*(idratazione/100))-acqua).toFixed(0);
  document.getElementById("res_lie").innerHTML = ((numero_p*farina*0.01)-lievito).toFixed(2);
  document.getElementById("res_sal").innerHTML = (numero_p*farina*0.022).toFixed(1);
  document.getElementById("res_oli").innerHTML = (numero_p*farina*0.01).toFixed(1);
}

function calcolaTeglia(area, numero_p, idratazione){
  var peso= area*0.50;
  var farina=peso*0.55;

  document.getElementById("res_far").innerHTML = (numero_p*farina).toFixed(0);
  var acqua=document.getElementById("res_h2o").innerHTML = (numero_p*farina*(idratazione/100)).toFixed(0);
  document.getElementById("res_lie").innerHTML = (numero_p*farina*0.007).toFixed(2);
  document.getElementById("res_sal").innerHTML = ((numero_p*acqua*25)/1000).toFixed(1);
  document.getElementById("res_oli").innerHTML = ((numero_p*acqua*20)/1000).toFixed(0);
}

function calcolaTonda(area, numero_p, idratazione){
  var peso = (area/6.45)*2.5;
  var farina = peso*0.65;

  document.getElementById("res_far").innerHTML = (numero_p*farina).toFixed(0);
  document.getElementById("res_h2o").innerHTML = (numero_p*farina*(idratazione/100)).toFixed(0);
  document.getElementById("res_lie").innerHTML = (numero_p*farina*0.004).toFixed(2);
  document.getElementById("res_sal").innerHTML = (numero_p*farina*0.02).toFixed(1);
  document.getElementById("res_oli").innerHTML = (numero_p*farina*0.02).toFixed(1);
}

function tondaMode(){ 
  var biga=document.getElementById("ris_biga");
  if (biga.classList.contains("visible")){
    biga.classList.replace("visible", "hidden");  
  }

  var larghezza=document.getElementById("larghezza_div");
  if (larghezza.classList.contains("visible")){
    larghezza.classList.replace("visible", "hidden");
  }
  var profondita=document.getElementById("profondita_div");
  if (profondita.classList.contains("visible")){
    profondita.classList.replace("visible", "hidden");
  }
  var diametro=document.getElementById("diametro_div");
  if (diametro.classList.contains("hidden")){
    diametro.classList.replace("hidden", "visible");
  }
}

function napoletanaMode(){
  var biga=document.getElementById("ris_biga");
  if (biga.classList.contains("hidden")){
    biga.classList.replace("hidden", "visible");  
  }

  var larghezza=document.getElementById("larghezza_div");
  if (larghezza.classList.contains("visible")){
    larghezza.classList.replace("visible", "hidden");
  }
  var profondita=document.getElementById("profondita_div");
  if (profondita.classList.contains("visible")){
    profondita.classList.replace("visible", "hidden");
  }
  var diametro=document.getElementById("diametro_div");
  if (diametro.classList.contains("hidden")){
    diametro.classList.replace("hidden", "visible");
  }
}

function tegliaMode(){
  var biga=document.getElementById("ris_biga");
  if (biga.classList.contains("visible")){
    biga.classList.replace("visible", "hidden");  
  }
  var larghezza=document.getElementById("larghezza_div");
  if (larghezza.classList.contains("hidden")){
    larghezza.classList.replace("hidden", "visible");
  }
  var profondita=document.getElementById("profondita_div");
  if (profondita.classList.contains("hidden")){
    profondita.classList.replace("hidden", "visible");
  }
  var diametro=document.getElementById("diametro_div");
  if (diametro.classList.contains("visible")){
    diametro.classList.replace("visible", "hidden");
  }
}


