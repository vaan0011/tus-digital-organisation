/**
 * TuS Spielerbarometer – Google Forms Setup (Google Apps Script / V8)
 *
 * BINDUNG: Dieses Script im PRIVATEN Google Sheet
 * "TuS Spielerbarometer – Datenbasis und Auswertung (VERTRAULICH)"
 * unter Erweiterungen > Apps Script ablegen.
 *
 * Erststart: erstelleWelle('2026-H2')
 * Folgewellen: erstelleWelle('2027-H1') / erstelleWelle('2027-H2') ...
 * Nachimport/Fehlerreparatur: synchronisiereAntworten()
 *
 * Keine Spreadsheet-ID, kein Token, kein Einzelfeedback ins öffentliche GitHub schreiben.
 */
const SB = Object.freeze({
  title: "TuS Spielerbarometer",
  answerSheet: "ANTWORTEN_IMPORT",
  catalogSheet: "FRAGENKATALOG",
  wavesSheet: "WELLEN",
  formFolder: "01 Fragebogen und Kommunikation",
  ratingValues: ["1", "2", "3", "4", "5", "Kann ich nicht beurteilen"],
  groups: [
    ["Allgemeine Zufriedenheit", "Wie erlebst du den TuS als Verein?"],
    ["Anlage und Ausstattung", "Wie beurteilst du die Rahmenbedingungen?"],
    ["Training und Entwicklung", "Wie erlebst du Training und deine sportliche Entwicklung?"],
    ["Mannschaft und Miteinander", "Wie erlebst du Zusammenarbeit und gegenseitigen Umgang?"],
    ["Kommunikation und Vereinsführung", "Wie funktionieren Information und Zusammenarbeit im Verein?"]
  ],
  priorities: [
    "Sportanlage und Ausstattung",
    "Trainingsgestaltung und Trainingsbedingungen",
    "Sportliche Entwicklung und Förderung",
    "Zusammenhalt innerhalb der Mannschaft",
    "Umgang miteinander und Fairness",
    "Kommunikation und Informationsfluss",
    "Organisation des Spielbetriebs",
    "Zusammenarbeit zwischen Spielern, Trainern und Vorstand"
  ]
});

function erstelleWelle(welle) {
  if (!/^20\d{2}-H[12]$/.test(String(welle))) {
    throw new Error("Welle muss z. B. 2026-H2 oder 2027-H1 heißen.");
  }
  const ss = SpreadsheetApp.getActiveSpreadsheet();
  if (!ss) throw new Error("Dieses Script muss im privaten Datenbasis-Sheet erstellt werden.");
  const props = PropertiesService.getScriptProperties();
  const key = "SPIELERBAROMETER_FORM_" + welle;
  const existing = props.getProperty(key);
  if (existing) {
    const f = FormApp.openById(existing);
    Logger.log("Bereits vorhanden: " + f.getPublishedUrl());
    return f.getPublishedUrl();
  }

  const catalog = ss.getSheetByName(SB.catalogSheet);
  const waves = ss.getSheetByName(SB.wavesSheet);
  const out = ss.getSheetByName(SB.answerSheet);
  if (!catalog || !waves || !out) throw new Error("Datenbasis-Tabs fehlen.");
  const entries = catalog.getDataRange().getValues().slice(1)
    .filter(row => /^(Q\d{2}|F\d{2}|P01)$/.test(String(row[0])));

  const form = FormApp.create(SB.title + " " + welle);
  form.setDescription(
    "Deine Meinung. Unser Verein. Gemeinsam besser werden.\n" +
    "Freiwillige Spielerbefragung der 1. und 2. Mannschaft (ca. 8–10 Minuten). " +
    "Wir erfassen keine Namen und keine E-Mail-Adressen. Die Angaben werden " +
    "ausschließlich für die Weiterentwicklung des Vereins ausgewertet. " +
    "Mannschaftsangabe und Freitexte sind freiwillig. " +
    "Freitexte und Mannschaft können eine Wiedererkennung ermöglichen; " +
    "bitte nenne keine Personen und melde sensible Vorfälle direkt vertraulich an den Vorstand. " +
    "Ergebnisse werden nur zusammengefasst berichtet."
  );
  form.setCollectEmail(false);
  form.setLimitOneResponsePerUser(false);
  form.setPublishingSummary(false);
  form.setShowLinkToRespondAgain(false);
  form.setAllowResponseEdits(false);
  form.setProgressBar(true);
  form.setShuffleQuestions(false);
  form.setConfirmationMessage(
    "Danke für deine Rückmeldung! Wir werden die Ergebnisse auswerten und " +
    "die wichtigsten Verbesserungsmaßnahmen mit den Mannschaften teilen."
  );

  form.addListItem()
    .setTitle("TEAM – In welcher Mannschaft spielst du aktuell?")
    .setChoiceValues(["1. Mannschaft", "2. Mannschaft", "Möchte ich nicht angeben"])
    .setRequired(false);

  for (const [groupName,description] of SB.groups) {
    form.addPageBreakItem().setTitle(groupName).setHelpText(description);
    for (const [id,group,question] of entries) {
      if (group !== groupName) continue;
      if (/^Q\d{2}$/.test(id)) {
        form.addMultipleChoiceItem()
          .setTitle(id + " – " + question)
          .setChoiceValues(SB.ratingValues)
          .setHelpText("1 = trifft überhaupt nicht zu | 5 = trifft voll und ganz zu")
          .setRequired(true);
      } else if (/^F\d{2}$/.test(id)) {
        form.addParagraphTextItem().setTitle(id + " – " + question).setRequired(false);
      }
    }
  }
  form.addPageBreakItem().setTitle("Prioritäten und Abschluss")
    .setHelpText("Welche Verbesserungen sind dir am wichtigsten?");
  const box = form.addCheckboxItem()
    .setTitle("P01 – In welchen ZWEI Bereichen sollte sich der TuS vorrangig verbessern?")
    .setChoiceValues(SB.priorities).setRequired(false);
  box.setValidation(
    FormApp.createCheckboxValidation()
      .setHelpText("Bitte maximal zwei Bereiche auswählen.")
      .requireSelectAtMost(2).build()
  );
  const finalFree = entries.find(x => x[0] === "F05");
  if (finalFree) form.addParagraphTextItem()
    .setTitle(finalFree[0] + " – " + finalFree[2]).setRequired(false);

  // Antworten landen in einem *privaten* Google Sheet. Dies erzeugt zusätzlich
  // einen Google-Forms-Rohdaten-Tab; die aggregierte Trendtabelle ist getrennt.
  form.setDestination(FormApp.DestinationType.SPREADSHEET, ss.getId());

  // Das Formulardokument liegt bei den Vorlagen; kein öffentliches Drive-Sharing.
  const file = DriveApp.getFileById(ss.getId());
  const parentIter = file.getParents();
  if (parentIter.hasNext()) {
    const privateFolder = parentIter.next();
    const projectParents = privateFolder.getParents();
    if (projectParents.hasNext()) {
      const projectFolder = projectParents.next();
      const formsFolders = projectFolder.getFoldersByName(SB.formFolder);
      if (formsFolders.hasNext()) {
        DriveApp.getFileById(form.getId()).moveTo(formsFolders.next());
      }
    }
  }

  if (form.supportsAdvancedResponderPermissions()) form.setPublished(true);
  else form.setAcceptingResponses(true);

  props.setProperty("SPIELERBAROMETER_SS_ID", ss.getId());
  props.setProperty(key, form.getId());

  const data = waves.getDataRange().getValues();
  let row = data.findIndex((r,i) => i > 0 && String(r[0]) === String(welle)) + 1;
  if (!row) {
    waves.appendRow([welle,"","", "Veröffentlicht – interner Test offen","","",""]);
    row=waves.getLastRow();
  }
  waves.getRange(row,4).setValue("Veröffentlicht – interner Test offen");
  waves.getRange(row,5).setValue(form.getPublishedUrl());

  // Automatischer Import der Formularantworten in das normierte, private Tab.
  ScriptApp.newTrigger("synchronisiereAntworten")
    .forForm(form).onFormSubmit().create();

  Logger.log("ANTWORTLINK: " + form.getPublishedUrl());
  Logger.log("BEARBEITUNG (VERTRAULICH): " + form.getEditUrl());
  Logger.log("Bitte vor Versand mit Inkognito-Fenster und Testantwort prüfen.");
  return form.getPublishedUrl();
}

function synchronisiereAntworten() {
  const props = PropertiesService.getScriptProperties();
  const ssId = props.getProperty("SPIELERBAROMETER_SS_ID");
  if (!ssId) throw new Error("Zuerst erstelleWelle('2026-H2') ausführen.");
  const ss = SpreadsheetApp.openById(ssId);
  const out = ss.getSheetByName(SB.answerSheet);
  if (!out) throw new Error("ANTWORTEN_IMPORT-Tab fehlt.");
  const last = out.getLastRow();
  const known = new Set(last > 1
    ? out.getRange(2,35,last-1,1).getValues().map(x => String(x[0]))
    : []);
  const newRows = [];

  const all = props.getProperties();
  const names = Object.keys(all).filter(k => k.startsWith("SPIELERBAROMETER_FORM_"));
  for (const key of names) {
    const wave = key.replace("SPIELERBAROMETER_FORM_","");
    const form = FormApp.openById(all[key]);
    for (const response of form.getResponses()) {
      const responseId = response.getId();
      if (!responseId || known.has(responseId)) continue;
      const answers = {};
      for (const item of response.getItemResponses()) {
        const title = item.getItem().getTitle();
        const match = title.match(/^(Q\d{2}|F\d{2}|P01|TEAM)\s*[–-]/);
        if (match) answers[match[1]] = item.getResponse();
      }
      const rating = v => /^[1-5]$/.test(String(v||"")) ? Number(v) : "";
      const priority = Array.isArray(answers.P01) ? answers.P01 : [];
      const row = [
        wave,response.getTimestamp(),answers.TEAM || "",
        ...Array.from({length:24},(_,i)=>rating(answers["Q"+String(i+1).padStart(2,"0")])),
        ...Array.from({length:5},(_,i)=>answers["F"+String(i+1).padStart(2,"0")] || ""),
        priority[0] || "",priority[1] || "",responseId
      ];
      if(row.length !== 35) throw new Error("Normierungsfehler: erwartete 35 Spalten.");
      newRows.push(row);
      known.add(responseId);
    }
  }
  if (newRows.length) out.getRange(out.getLastRow()+1,1,newRows.length,35).setValues(newRows);
  Logger.log(newRows.length + " neue Antworten importiert.");
  return newRows.length;
}
