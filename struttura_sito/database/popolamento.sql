INSERT INTO utenti (email, pword, username) VALUES 
(
  "pizzaadmin@mail.com",
  "$2y$10$1hgewpV8puZzoBALrmXyLeOgtTf1zNno9I0ZpvEB43GtOKHGVEO66",
  "admin"
),
(
  "pizzauser@mail.com",
  "$2y$10$db5xt4FXph6fLv.iTeQ2.Oe9q/HxB/HzBlpv5J93JaA3yxrItxZKW",
  "user"
),
(
  "gordon@mail.com",
  "$2y$10$y2GMVQlUKaRJGmXWGSNcVesgybz/PT9M.7rsERvushv.N1ZeQWghW",
  "gordon"
),
(
  "benedetta@mail.com",
  "$2y$10$K57uL2lB5eiw4V/6fJzfyurVS6B5Ll2wTSMvAknO5KD5gxHLF.VFK",
  "benedetta"
),
(
  "jamie@mail.com",
  "$2y$10$dlRHIKpO9PgbTtKKIqyMWejFRPGnZIDecEG4UIUVYEvF8ol0ojAhC",
  "jamie"
),
(
  "massimo@mail.com",
  "$2y$10$HtAY7eapiS/4ll3iYDdNYOX2bvkMkOEISFxqQrvfuYfkU/JLMduZW",
  "massimo"
);

INSERT INTO ricette (nome, vegetariana, tipo, ingredienti, informazioni, autore, nome_immagine) VALUES
(
  "Diavola",
  FALSE,
  "Napoletana",
  "pomodoro, mozzarella, salame piccante, peperoncino",
  "La pizza alla diavola deve il suo nome agli ingredienti piccanti, che devono letteralmente bruciare: una ricetta per i palati più coraggiosi! Può essere resa piccante in diversi modi: c’è chi aggiunge peperoncino o addirittura tabasco, chi preferisce al salamino la salsiccia piccante o la 'nduja.",
  1,
  "diavola.jpg"
),
(
  "Quattro Formaggi",
  TRUE,
  "Tonda",
  "mozzarella, fontina, gorgonzola, parimgiano",
  "La pizza 4 formaggi è una meravigliosa pizza bianca morbida e golosa, che si può realizzare anche nella versione con il pomodoro. Questa versione è una delle più apprezzate in Italia e non solo, ed è un modo perfetto per valorizzare i formaggi e gustarli in un piatto dal sapore incredibile.",
  1,
  "quattro_formaggi.jpg"
),
(
  "Margherita",
  TRUE,
  "Napoletana",
  "pomodoro, fiordilatte, basilico, olio",
  "La pizza Margherita è la tipica pizza napoletana, condita con pomodoro, mozzarella (tradizionalmente è usato il fior di latte, non quella di bufala), basilico fresco, sale e olio; è, assieme alla pizza marinara, la più popolare pizza italiana. Rappresenta sicuramente il simbolo per antonomasia (tra i tanti gusti) del patrimonio culturale e culinario italiano, diffusa per la sua fama in tutto il mondo e in tutte le sue varianti. La leggenda narra che nel giugno 1889, per onorare la Regina d'Italia, Margherita di Savoia, il cuoco Raffaele Esposito della Pizzeria Brandi inventò una pietanza che chiamò proprio Pizza Margherita (con riferimento al fatto che il termine pizza, allora sconosciuto al di fuori della città partenopea, indicava quasi sempre le torte dolci), dove i condimenti salati capitatigli tra le mani, pomodoro, mozzarella e basilico, rappresentavano addirittura gli stessi colori della bandiera italiana.",
  1,
  "margherita.jpg"
),
(
  "Ruccola e Pomodorini",
  TRUE,
  "In Teglia",
  "pomodoro, mozzarella, pomodorini, ruccola, grana",
  "Ricetta molto fresca, ideale per l'estate. I pomodorini, la ruccola e le scaglie di grana vanno aggiunte dopo la cottura.",
  1,
  "ruccola_e_pomodorini.jpg"
),
(
  "Patate e Rosmarino",
  TRUE,
  "In Teglia",
  "mozzarella, patate, rosmarino",
  "La Pizza con patate e rosmarino è una pizza bianca, senza pomodoro, semplice, economica realizzata con pochissimi ingredienti: ottima pasta lievitata fatta in casa e patate tagliate a fette sottili profumate al rosmarino che ricoprono tutta la superficie dell’impasto. Le patate in cottura si ammorbidiscono, creando uno strato morbido, dorato e profumato che insieme all’impasto soffice diventa pura poesia al palato!",
  3,
  "patate_e_rosmarino.jpg"
);

INSERT INTO commenti (autore, ricetta, contenuto, data_ora) VALUES
(
  3,
  1,
  "La migliore se siete amanti del piccante",
  "2021-01-10 13:08:22"
),
(
  4,
  2,
  "Fantastica! E' possibile anche cambiare le combinazioni di formaggi",
  "2021-01-11 14:08:00"
),
(
  3,
  3,
  "Classica! La pizza per eccellenza. Non cambiare niente in questa ricetta",
  "2021-01-12 07:23:00"
),
(
  5,
  3,
  "100 vlte meglio cn la mozzarella di bufala!!1!",
  "2021-01-13 22:11:00"
),
(
  4,
  4,
  "Fantastica ricetta che non necessita di forno a legna",
  "2021-01-15 15:08:00"
),
(
  5,
  4,
  "La VERA pizza è sottile, non si fa così!!!",
  "2021-01-16 21:16:00"
),
(
  3,
  5,
  "Pizza invernale per una bella carica",
  "2021-01-17 14:43:00"
);

INSERT INTO likes (utente, ricetta) VALUES 
(3, 1),
(4, 1),
(4, 2),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(5, 4),
(6, 4),
(3, 5),
(5, 5);
