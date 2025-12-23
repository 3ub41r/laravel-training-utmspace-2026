<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var rawData = {!! json_encode($dataArray) !!};

    var data = new google.visualization.DataTable();

    // Kolom label (misal Year)
    data.addColumn('string', rawData[0][0]);

    // Kolom data untuk tiap level course
    for (var i = 1; i < rawData[0].length; i++) {
        data.addColumn('number', rawData[0][i]);
    }

    // Kolom anotasi total
    data.addColumn({ type: 'string', role: 'annotation' });

    // Tambahkan baris data
    for (var i = 1; i < rawData.length; i++) {
        var row = [rawData[i][0]]; // Year
        var total = 0;

        for (var j = 1; j < rawData[i].length; j++) {
            var value = rawData[i][j];
            row.push(value);
            total += value;
        }

        row.push(total.toString()); // total sebagai annotation
        data.addRow(row);
    }

    var options = {
        fontSize: 12,
        chartArea: { left: 70, top: 50, width: '75%', height: '65%' },
        hAxis: { textStyle: { fontSize: 12 } },
        vAxis: { textStyle: { fontSize: 12 }, minValue: 0 },
        legend: { position: 'bottom', textStyle: { fontSize: 12 } },
        isStacked: true,
        annotations: { 
            alwaysOutside: true, 
            textStyle: { fontSize: 14, bold: true, auraColor: 'none' } // bigger total
        },
        tooltip: { isHtml: true },
        width: '100%',
        height: 450,
        colors: ['#1f77b4','#ff7f0e','#2ca02c','#d62728','#9467bd'],
        animation: { duration: 800, easing: 'out', startup: true },
        bar: { groupWidth: '70%' } // controls stack spacing
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('barchart_material'));
    chart.draw(data, options);

    // redraw on window resize for responsiveness
    window.addEventListener('resize', function() {
        chart.draw(data, options);
    });
}
</script>

<div id="barchart_material" style="width: 100%; height: 450px;"></div>
