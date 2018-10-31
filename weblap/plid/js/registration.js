$('.datepicker').pickadate({
selectMonths: true, // Creates a dropdown to control month
selectYears: 75, // Creates a dropdown of 15 years to control year,
today: 'Ma',
clear: 'Törlés',
close: 'Ok',
// The title label to use for the month nav buttons
labelMonthNext: 'Következő hónap',
labelMonthPrev: 'Előző hónap',

// The title label to use for the dropdown selectors
labelMonthSelect: 'Válasszon hónapot',
labelYearSelect: 'Válasszon évet',

// Months and weekdays
monthsFull: ['Január', 'Február', 'Március', 'Április', 'Május', 'Június', 'Július', 'Augusztus', 'Szeptember', 'Október', 'November', 'December'],
monthsShort: ['Jan', 'Feb', 'Már', 'Ápr', 'Máj', 'Jún', 'Júl', 'Aug', 'Szep', 'Okt', 'Nov', 'Dec'],
weekdaysFull: ['Vasárnap', 'Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat'],
weekdaysShort: ['Vas', 'Hé', 'Ke', 'Sze', 'Csüt', 'Pé', 'Sz'],

// Materialize modified
weekdaysLetter: ['H', 'K', 'Sze', 'CS', 'P', 'Szo', 'V'],
// The format to show on the `input` element
format: 'yyyy, mmmm, dd',
closeOnSelect: false // Close upon selecting a date,
});