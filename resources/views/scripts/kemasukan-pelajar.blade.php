<script>
document.getElementById('courseLevel').addEventListener('change', function() {
    let level = this.value;
    let semesterSelect = document.getElementById('semester');

    // Clear existing options
    semesterSelect.innerHTML = '<option value="">-- Semua Sesi Pengambilan --</option>';

    if(level) {
        fetch(`/get-semesters?courseLevel=${level}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(sem => {
                    let option = document.createElement('option');
                    option.value = sem;
                    option.text = sem;
                    semesterSelect.appendChild(option);
                });
            })
            .catch(err => console.error(err));
    }
});
</script>


<script>
const programSearch = document.getElementById('programSearch');
const programTable = document.getElementById('programTable').getElementsByTagName('tbody')[0];

programSearch.addEventListener('keyup', function() {
    const filter = programSearch.value.toLowerCase();
    const rows = programTable.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        // Abaikan baris jumlah keseluruhan (biasanya tiada <td> pertama)
        const cells = rows[i].getElementsByTagName('td');
        if (cells.length === 0) continue;

        // Kolum kedua biasanya nama program
        const textValue = (cells[1].textContent || cells[1].innerText).toLowerCase();

        // Papar atau sembunyi
        rows[i].style.display = textValue.includes(filter) ? '' : 'none';
    }
});
</script>

<script>
const facultySearch = document.getElementById('facultySearch');
const facultyTable = document.getElementById('facultyTable').getElementsByTagName('tbody')[0];

facultySearch.addEventListener('keyup', function() {
    const filter = facultySearch.value.toLowerCase();
    const rows = facultyTable.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        if (cells.length === 0) continue; // skip baris jumlah keseluruhan

        // Kolum kedua biasanya nama fakulti
        const textValue = (cells[1].textContent || cells[1].innerText).toLowerCase();

        // Tunjuk atau sembunyi baris
        rows[i].style.display = textValue.includes(filter) ? '' : 'none';
    }
});
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load("current", { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        drawColumnChart(
            "columnchart_values",
            [
                ["Kelayakan Akademik", "Jumlah", { role: "style" }],
                ["SPM", {{ $qualifications->get('1', 0) }}, "#1f77b4"],
                ["STPM", {{ $qualifications->get('2', 0) }}, "#ff7f0e"],
                ["STAM", {{ $qualifications->get('3', 0) }}, "#2ca02c"],
                ["Matrikulasi/Asasi", {{ $qualifications->get('4', 0) }}, "#d62728"],
                ["Diploma/Setaraf", {{ $qualifications->get('5', 0) }}, "#9467bd"],
                ["Bachelor's Degree", {{ $qualifications->get('6', 0) }}, "#8c564b"],
                ["APEL A – Tahap 6", {{ $qualifications->get('7', 0) }}, "#e377c2"],
                ["DVM", {{ $qualifications->get('8', 0) }}, "#7f7f7f"],
                ["Tiada Data", {{ $qualifications->get(null, 0) }}, "#bcbd22"]
            ]
        );
    }

    function drawColumnChart(containerId, dataArray) {
        var container = document.getElementById(containerId);
        var data = google.visualization.arrayToDataTable(dataArray);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1, {
            calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation"
        }, 2]);

        var options = {
            bars: 'vertical', // Tukar kepada menegak
            bar: { groupWidth: "70%" },
            legend: { position: "none" },
            chartArea: { left: 50, top: 50, bottom: 80, right: 30 },
            tooltip: { textStyle: { fontSize: 11 }, showColorCode: true },
            annotations: {
                alwaysOutside: true,
                textStyle: {
                    fontSize: 11,
                    color: '#fff' // teks annotation putih supaya nampak pada bar gelap
                }
            },
            hAxis: {
                textStyle: { fontSize: 11 },
                slantedText: true,
                slantedTextAngle: 45
            },
            vAxis: {
                textStyle: { fontSize: 11 }
            },
            titleTextStyle: { fontSize: 11 },
            height: Math.max(300, data.getNumberOfRows() * 50),
            colors: ['#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd', '#8c564b', '#e377c2', '#7f7f7f', '#bcbd22']
        };

        var chart = new google.visualization.ColumnChart(container);
        chart.draw(view, options);
    }

    // Responsive redraw on window resize
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(drawCharts, 250);
    });
</script>


<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Jantina', 'Jumlah'],
      ["Lelaki", {{ $genders->get('Male', 0) }}],
      ["Perempuan", {{ $genders->get('Female', 0) }}]
    ]);

    var options = {
      pieHole: 0.4, // Donut chart
      pieSliceText: 'percentage',
      legend: {
        position: 'bottom',
        alignment: 'center',
        textStyle: { fontSize: 14 }
      },
      tooltip: { text: 'both' },
      chartArea: { left: 20, top: 50, width: '90%', height: '75%' },
      fontName: 'Arial',
      colors: ['#1f77b4', '#ff69b4'] // Male = Blue, Female = Pink
    };

    var chart = new google.visualization.PieChart(document.getElementById('jantina'));

    function resizeChart() {
      chart.draw(data, options);
    }

    resizeChart();
    window.addEventListener('resize', resizeChart);
  }
</script>

<script type="text/javascript">
    google.charts.load("current", { packages: ['corechart', 'bar'] });
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        var data = google.visualization.arrayToDataTable([
    ["Status Perkahwinan", "Jumlah", { role: "style" }],
    ["Bujang", {{ json_encode($maritalStatuses->get('Single', 0)) }}, "#457B9D"],   // Biru pekat
    ["Berkahwin", {{ json_encode($maritalStatuses->get('Married', 0)) }}, "#E76F51"], // Oren/merah pekat
    ["Balu / Duda", {{ json_encode($maritalStatuses->get('Widowed', 0)) }}, "#2A9D8F"], // Hijau pekat
    ["Berpisah", {{ json_encode($maritalStatuses->get('Divorced', 0)) }}, "#D62828"]  // Merah pekat
]);




        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1, {
            calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation"
        }, 2]);

        var options = {
            legend: { position: "none" },
            chartArea: { width: '70%', height: '70%' },
            bars: 'horizontal', // <-- horizontal bars
            bar: { groupWidth: "70%" },
            annotations: { alwaysOutside: true, textStyle: { fontSize: 11, color: '#fff' } },
            hAxis: { minValue: 0 },
            vAxis: { textStyle: { fontSize: 11 } }
        };

        var chart = new google.visualization.BarChart(document.getElementById("perkahwinan"));
        chart.draw(view, options);
    }

    // Redraw chart when window resizes
    window.addEventListener('resize', function() {
        clearTimeout(window.resizeTimeout);
        window.resizeTimeout = setTimeout(drawCharts, 250);
    });
</script>












