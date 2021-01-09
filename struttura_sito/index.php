<!-- 
  TODO
  - ROUTING?
  - [x] sistemare le pagine con i link corretti
  - [ ] aggiungere tutte la pagine
  - [ ] aggingere pagine: nav, header, footer
  - [ ] end: testare sul server apache
  - [ ] validare codice: placeholder tags
    - problema con tags placeholder: trovare nuovi? check pagina finale nel browser?
 -->

 <?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
  case "/" :
    require __DIR__ . "/pages/php/home.php";
    break;
  case "/ricette" :
    require __DIR__ . "/pages/php/ricette.php";
    break;
  case "/ricetta_aggiungi" :
    require __DIR__ . "/pages/php/ricetta_aggiungi.php";
    break;
  case "/ricetta" :
    require __DIR__ . "/pages/php/ricetta.php";
    break;
  case "/calcolatore" :
    require __DIR__ . "/pages/php/calcolatore.php";
    break;
  default:
    echo "Bad URL";
    break;
}
?>
