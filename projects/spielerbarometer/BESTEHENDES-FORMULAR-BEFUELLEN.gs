/**
 * TuS Spielerbarometer 2026/27: VORHANDENES leeres Google Form befüllen.
 *
 * Anwendung:
 * 1. Im bestehenden Google Form rechts oben: ⋮ -> Apps Script.
 * 2. Diesen Inhalt nach Code.gs kopieren, speichern.
 * 3. "bestehendesFormularBefuellen" auswählen und ausführen.
 *
 * Erstellt KEIN zusätzliches Formular. Keine Veröffentlichung durch das Script.
 * Kann bewusst nur einmal auf einem noch leeren Formular ausgeführt werden.
 */

const SPIELERBAROMETER = {
  tabellenId: "1UTRvQ9U_xUTnUrVBRSN5LaqjAiFPmrRXjH8QwwHK3Xc",
  titel: "TuS Spielerbarometer – Hinrunde 2026/27",
  skala: ["1", "2", "3", "4", "5", "Kann ich nicht beurteilen"],
  abschnitte: [
    {
      titel: "A – Allgemeine Zufriedenheit",
      hinweis: "Wie erlebst du den TuS Mingolsheim als Verein?",
      fragen: [
        ["Q01", "Ich fühle mich beim TuS Mingolsheim wohl."],
        ["Q02", "Ich gehe gerne zum Training und zu den Spielen."],
        ["Q03", "Mein Engagement für den Verein wird wertgeschätzt."],
        ["Q04", "Ich kann mir gut vorstellen, auch in der kommenden Saison beim TuS zu spielen."]
      ]
    },
    {
      titel: "B – Anlage und Ausstattung",
      hinweis: "Wie beurteilst du die Bedingungen für Training und Spiele?",
      fragen: [
        ["Q05", "Die Qualität unserer Trainings- und Spielfelder ist gut."],
        ["Q06", "Umkleidekabinen und sanitäre Anlagen entsprechen meinen Erwartungen."],
        ["Q07", "Die Trainingsausstattung ist ausreichend und in gutem Zustand."]
      ],
      freitext: ["F01", "Was sollten wir an unserer Sportanlage oder Ausstattung verbessern?"]
    },
    {
      titel: "C – Training und Entwicklung",
      hinweis: "Wie erlebst du den Trainingsbetrieb und deine sportliche Entwicklung?",
      fragen: [
        ["Q08", "Unsere Trainingseinheiten sind gut vorbereitet und strukturiert."],
        ["Q09", "Die Trainingsinhalte sind abwechslungsreich und sinnvoll."],
        ["Q10", "Trainingsumfang und -intensität sind angemessen."],
        ["Q11", "Das Training bereitet uns gut auf die Anforderungen im Spiel vor."],
        ["Q12", "Ich weiß, welche sportlichen Erwartungen an mich gestellt werden."],
        ["Q13", "Ich erhalte hilfreiches Feedback, um mich sportlich weiterzuentwickeln."],
        ["Q14", "Mit Fehlern im Training und im Spiel wird konstruktiv umgegangen."]
      ],
      freitext: ["F02", "Was gefällt dir am Trainingsbetrieb besonders gut, und was würdest du verändern?"]
    },
    {
      titel: "D – Mannschaft und Miteinander",
      hinweis: "Wie erlebst du Fairness, Zusammenhalt und Respekt?",
      fragen: [
        ["Q15", "Der Zusammenhalt innerhalb unserer Mannschaft ist gut."],
        ["Q16", "Innerhalb der Mannschaft und mit sportlich Verantwortlichen herrscht gegenseitiger Respekt."],
        ["Q17", "Sportliche Entscheidungen (z. B. Aufstellungen und Einsatzzeiten) sind für mich nachvollziehbar."],
        ["Q18", "Ich habe den Eindruck, dass alle Spieler fair behandelt werden."],
        ["Q19", "Ich kann Kritik im sportlichen Bereich ansprechen, ohne Nachteile befürchten zu müssen."],
        ["Q20", "Die sportlichen Ziele unserer Mannschaft sind klar und verständlich."]
      ],
      freitext: ["F03", "Was könnte das sportliche Miteinander verbessern?"]
    },
    {
      titel: "E – Kommunikation und Vereinsführung",
      hinweis: "Wie gut funktionieren Informationen und Zusammenarbeit im Verein?",
      fragen: [
        ["Q21", "Wichtige Informationen zu Training, Spielen und Terminen erreichen mich rechtzeitig."],
        ["Q22", "Absprachen und organisatorische Entscheidungen werden zuverlässig kommuniziert."],
        ["Q23", "Der Vorstand ist für Spieler ansprechbar und zeigt Interesse an den Mannschaften."],
        ["Q24", "Anliegen und Wünsche der Spieler werden vom Verein ernst genommen."]
      ],
      freitext: ["F04", "Was könnten wir in der Kommunikation und Zusammenarbeit verbessern?"]
    }
  ],
  prioritaeten: [
    "Sportanlage und Ausstattung",
    "Trainingsgestaltung und Trainingsbedingungen",
    "Sportliche Entwicklung und Förderung",
    "Zusammenhalt innerhalb der Mannschaft",
    "Umgang miteinander und Fairness",
    "Kommunikation und Informationsfluss",
    "Organisation des Spielbetriebs",
    "Zusammenarbeit zwischen Spielern, Trainern und Vorstand"
  ]
};

function bestehendesFormularBefuellen() {
  const form = FormApp.getActiveForm();
  if (!form) {
    throw new Error("Bitte das Script direkt AUS DEM GEÖFFNETEN Google Form starten.");
  }

  // Schutz vor doppelten Fragen, bestehenden Antworten und unbeabsichtigtem Löschen.
  if (form.getResponses().length > 0) {
    throw new Error("Das Formular hat bereits Antworten. Es wird nichts überschrieben.");
  }
  const items = form.getItems();
  const nurStandardfrage = items.length === 1 &&
    items[0].getType() === FormApp.ItemType.MULTIPLE_CHOICE &&
    /^(Unbenannte Frage|Untitled Question)$/i.test(items[0].getTitle().trim());
  if (items.length > 0 && !nurStandardfrage) {
    throw new Error("Das Formular enthält bereits bearbeitete Fragen. Abbruch zum Schutz vor Duplikaten.");
  }
  if (nurStandardfrage) form.deleteItem(items[0]);

  form.setTitle(SPIELERBAROMETER.titel);
  form.setDescription(
    "Deine Meinung. Unser Verein. Gemeinsam besser werden.\n\n" +
    "Freiwillige Spielerbefragung der 1. und 2. Herrenmannschaft. " +
    "Wir möchten verstehen, was gut läuft und wo wir uns verbessern können. " +
    "Dauer: ungefähr 8–10 Minuten. Keine Namen oder E-Mail-Adressen.\n\n" +
    "Die Antworten werden vertraulich ausgewertet und nur zusammengefasst berichtet. " +
    "Mannschaftsangabe und Freitexte sind freiwillig. " +
    "Bitte keine Namen oder sensiblen persönlichen Vorfälle in Freitextfeldern nennen. " +
    "Durch Kombination aus Mannschaft und Freitext sind Rückschlüsse auf einzelne Personen " +
    "nicht vollständig auszuschließen."
  );
  form.setCollectEmail(false);
  form.setLimitOneResponsePerUser(false);
  form.setPublishingSummary(false);
  form.setAllowResponseEdits(false);
  form.setShowLinkToRespondAgain(false);
  form.setProgressBar(true);
  form.setShuffleQuestions(false);
  form.setConfirmationMessage(
    "Danke für deine Teilnahme! Wir werten die Rückmeldungen aus und " +
    "teilen die wichtigsten Verbesserungsmaßnahmen mit den Mannschaften."
  );

  form.addListItem()
    .setTitle("TEAM – In welcher Mannschaft spielst du aktuell?")
    .setChoiceValues(["1. Mannschaft", "2. Mannschaft", "Möchte ich nicht angeben"])
    .setRequired(false);

  for (const abschnitt of SPIELERBAROMETER.abschnitte) {
    form.addPageBreakItem()
      .setTitle(abschnitt.titel)
      .setHelpText(abschnitt.hinweis);

    for (const frage of abschnitt.fragen) {
      form.addMultipleChoiceItem()
        .setTitle(frage[0] + " – " + frage[1])
        .setHelpText("1 = trifft überhaupt nicht zu; 5 = trifft voll und ganz zu")
        .setChoiceValues(SPIELERBAROMETER.skala)
        .setRequired(true);
    }

    if (abschnitt.freitext) {
      form.addParagraphTextItem()
        .setTitle(abschnitt.freitext[0] + " – " + abschnitt.freitext[1])
        .setRequired(false);
    }
  }

  form.addPageBreakItem().setTitle("F – Verbesserungswünsche");
  const prioritaeten = form.addCheckboxItem()
    .setTitle("P01 – In welchen ZWEI Bereichen sollte sich der TuS vorrangig verbessern?")
    .setChoiceValues(SPIELERBAROMETER.prioritaeten)
    .setRequired(false);
  prioritaeten.setValidation(
    FormApp.createCheckboxValidation()
      .setHelpText("Bitte höchstens zwei Bereiche auswählen.")
      .requireSelectAtMost(2)
      .build()
  );
  form.addParagraphTextItem()
    .setTitle("F05 – Wenn du beim TuS eine Sache verbessern könntest: Welche wäre das? Gibt es noch etwas, das du uns sagen möchtest?")
    .setRequired(false);

  let speicher = "Noch kein privates Google Sheet verknüpft.";
  try {
    // Bestehende, nicht öffentlich freigegebene Spielerbarometer-Datenbasis.
    // Forms legt dort ein zusätzliches Rohantwort-Register an.
    SpreadsheetApp.openById(SPIELERBAROMETER.tabellenId);
    form.setDestination(
      FormApp.DestinationType.SPREADSHEET,
      SPIELERBAROMETER.tabellenId
    );
    speicher = "Private TuS-Sheets-Datenbasis erfolgreich verknüpft.";
  } catch (fehler) {
    // Das Formular bleibt trotzdem vollständig ausgefüllt.
    // Bei anderem Google-Konto muss der Zugriff auf das private Sheet
    // geklärt oder über "Antworten" ein privates neues Sheet gewählt werden.
    Logger.log("ACHTUNG: Tabellenverknüpfung fehlgeschlagen: " + fehler.message);
  }

  Logger.log("FORMULAR FERTIG: " + form.getEditUrl());
  Logger.log("TEILNEHMERLINK (erst nach Freigabe/Prüfung teilen): " +
             form.getPublishedUrl());
  Logger.log(speicher);
  Logger.log("Vor Veröffentlichung: Einstellungen, Datenschutztext und " +
             "Testantwort prüfen. Keine Rohantworten öffentlich freigeben.");
}