INSERT INTO utenti (email, pword, username, is_admin)
VALUES (
    "giancarlo.marini@gmail.com",
    "pesce",
    "pizza_master1",
    FALSE
),
(
    "gianmaria.terrini@gmail.com",
    "cane",
    "pizza_queen69",
    FALSE
),
(
    "gianfranco.cielini@gmail.com",
    "aquila",
    "pizza_admin1",
    TRUE
);

INSERT INTO ricette (nome, vegetariana, tipo, ingredienti, informazioni, autore, nome_immagine)
VALUES (
    "Diavola",
    FALSE,
    "Napoletana",
    "mozzarella, pomodoro, salamino piccante",
    "Procedimento per la diavola",
    3,
    "default.jpg"
),
(
    "Quattro Formaggi",
    TRUE,
    "Napoletana",
    "mozzarella, pomodoro, fontina, gorgonzola, parimgiano",
    "Procedimento per la qauttro formaggi",
    3,
    "quattro_formaggi.jpg"
),
(
    "Carbonara",
    FALSE,
    "Napoletana",
    "mozzarella, pomodoro, uova, pancetta, parmigiano",
    "Procedimento per la carbonara",
    3,
    "default.jpg"
),
(
    "Patatine e wurstel",
    FALSE,
    "Napoletana",
    "mozzarella, pomodoro, patatine, wurstel",
    "Procedimento per la patatine e wurstel",
    3,
    "default.jpg"
),
(
    "Funghi",
    TRUE,
    "Napoletana",
    "mozzarella, pomodoro, funghi",
    "Procedimento per la pizza coi funghi",
    3,
    "default.jpg"
),
(
    "Alpina",
    FALSE,
    "Napoletana",
    "mozzarella, pomodoro, gorgonzola, scamorza affumicata, brie, misto funghi, speck",
    "Procedimento per la alpina",
    2,
    "default.jpg"
),
(
    "Pizza in teglia",
    TRUE,
    "In teglia",
    "mozzarella, pomodoro", 
    "Procedimento per la pizza in teglia",
    3,
    "default.jpg"
);


INSERT INTO commenti (autore, ricetta, contenuto, data_ora)
VALUES (
    1,
    1,
    "buonissima",
    "2020-01-09T20:10:00"
  ),
  (
    1,
    2,
    "buonissima",
    "2020-01-11T20:10:00"
  ),
  (
    3,
    5,
    "buonissima",
    "2020-01-10T20:10:00"
  ),
  (
    2,
    2,
    "buonissima",
    "2020-01-08T20:10:00"
  ),
  (
    3,
    4,
    "buonissima",
    "2020-01-08T20:10:00"
  ),
  (
    3,
    1,
    "molto buona",
    "2020-01-10T20:10:00"
  ),
  (
    1,
    6,
    "molto buona",
    "2020-01-12T20:10:00"
  ),
  (
    2,
    3,
    "fantastica",
    "2020-01-12T20:10:00"
  ),
  (
    1,
    6,
    "cattiva",
    "2002-01-10T20:10:00"
  ),
  (
    2,
    4,
    "fantastica",
    "2020-01-12T20:10:00"
);

INSERT INTO likes (utente, ricetta)
VALUES (1, 1),
(1, 2),
(1, 5),
(1, 3),
(2, 1),
(2, 5),
(2, 6),
(3, 1),
(3, 4),
(3, 6),
(3, 5
);

