<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load("current", { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts() {
        // Chart 1: Qualifications
        drawBarChart(
            "columnchart_values",
            [
                ["Kelayakan Akademik", "Jumlah", { role: "style" }],
                ["SPM", {{ $qualifications->get('1', 0) }}, "#5b74af"],
                ["STPM", {{ $qualifications->get('2', 0) }}, "#5b74af"],
                ["STAM", {{ $qualifications->get('3', 0) }}, "#5b74af"],
                ["Matrikulasi/Asasi", {{ $qualifications->get('4', 0) }}, "#5b74af"],
                ["Diploma/Setaraf", {{ $qualifications->get('5', 0) }}, "#5b74af"],
                ["Bachelor's Degree", {{ $qualifications->get('6', 0) }}, "#5b74af"],
                ["APEL A – Tahap 6", {{ $qualifications->get('7', 0) }}, "#5b74af"],
                ["DVM", {{ $qualifications->get('8', 0) }}, "#5b74af"],
                ["Tiada Data", {{ $qualifications->get(null, 0) }}, "#5b74af"]
            ]
        );

        // Chart 2: Household Incomes
        drawBarChart(
            "incomes",
            [
                ["Pendapatan", "Jumlah", { role: "style" }],
                @foreach($countries as $country => $total)
                    ["{{ $country }}", {{ $total }}, "color: #5b74af"],
                @endforeach
            ]
        );
    }

    function drawBarChart(containerId, dataArray) {
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
            bars: 'horizontal',
            bar: { groupWidth: "70%" },
            legend: { position: "none" },
            chartArea: { left: 100, top: 20, bottom: 20, right: 30 },
            tooltip: { textStyle: { fontSize: 11 }, showColorCode: true },
            annotations: {
                alwaysOutside: true,
                textStyle: {
                    fontSize: 11,
                    color: '#000'
                }
            },
            hAxis: {
                textStyle: { fontSize: 11 }
            },
            vAxis: {
                textStyle: { fontSize: 11 }
            },
            titleTextStyle: { fontSize: 11 },
            height: Math.max(200, data.getNumberOfRows() * 40)
        };

        var chart = new google.visualization.BarChart(container);
        chart.draw(view, options);
    }

    // Responsive redraw on window resize
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(drawCharts, 250);
    });
</script>




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
