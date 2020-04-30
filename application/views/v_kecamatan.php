<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>

<head>

	<title>Visualisasi Data</title>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="<?=base_url()?>assets/js/bootstrap.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/js/leaflet.css"/>
	<link rel="stylesheet" href="<?=base_url()?>assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.css" />
	<script src="<?=base_url()?>assets/js//leaflet.js"></script>
	<script src="<?=base_url()?>assets/js/leaflet.ajax.js"></script>
	<script src="<?=base_url()?>assets/js/function.js"></script>
	<script src="<?=base_url()?>assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/loader.js"></script>

	<style>

html,body{
			height:100%;
			width:99.4%;
			
		}
		#map,
		#chart{
			height: 40.5vw;
			margin-top:4%;
			margin-right:0px;
			margin-left:0px;
			margin-bottom:0px;
			
		}
		#chart{
			padding-top:50px
		}
		#map{
border: 4px solid grey;
		}
		.info {
			padding: 6px 8px;
			font: 14px/16px Arial, Helvetica, sans-serif;
			background: white;
			background: rgba(255, 255, 255, 0.8);
			box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
			border-radius: 5px;
		}

		.info h4 {
			margin: 0 0 5px;
			color: #777;
		}

		.legend {
			text-align: left;
			line-height: 12px;
			color: #555;
		}

		.legend i {
			width: 12px;
			height: 12px;
			float: left;
			margin-right: 8px;
			opacity: 0.7;
		}
	</style>


</head>

<body>
<?php 
    include 'header.php';
?>
<div class="row">
	 <div id = 'chart' class="col-md-3" > 
		<div id='donutchart'> </div>
		<div id='barchart'></div>
	 </div>
	<div id = 'map' class="col-md-6"></div> 
	<div id = 'chart' class="col-md-3">
		<div id = 'piechart'></div>
		<div id='barchart2'></div>
	</div>
</div>
	<script src="<?=base_url()?>assets/js/jquery.min.js"></script>
	<!-- <script type="text/javascript" src="zxc.js"></script> -->
	<script>
      google.charts.load('current', {'packages':['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

		var data_mandi = $.ajax({
			url : "<?php echo site_url('c_kecamatan/getmandi/'),$kode ?>",
            dataType : "json",
            async:false
        }).responseJSON;
		
		console.log(data_mandi);
        var data = new google.visualization.DataTable(data_mandi);

        var options = {
		  title: 'Desa/Kelurahan berdasarkan sumber air mandi mayoritas keluarga',
          width: 250,
          legend: { position: 'none' },
          axes: {
            x: {
              0: { side: 'top', label: 'White to move'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById("barchart2"));
        chart.draw(data, options);
    	};
	</script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

		var data_sampah = $.ajax({
            url : "<?php echo site_url('c_kecamatan/getsampah/'),$kode ?>",
            dataType : "json",
            async:false
        }).responseText;
        //console.log(jsonData)
        
        var data = new google.visualization.DataTable(data_sampah);

        var options = {
          title: 'Desa/Kelurahan pembuangan sampah sebagian besar keluarga'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
	<script>
      google.charts.load('current', {'packages':['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {


        var data_minum = $.ajax({
            url : "<?php echo site_url('c_kecamatan/getminum/'),$kode ?>",
            dataType : "json",
            async:false
        }).responseText;
        //console.log(jsonData)
        
        var data = new google.visualization.DataTable(data_minum);

        var options = {
		  title: 'Desa/Kelurahan berdasarkan sumber air minum mayoritas keluarga',
          width: 250,
          legend: { position: 'none' },
          axes: {
            x: {
              0: { side: 'top', label: 'White to move'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById("barchart"));
        chart.draw(data, options);
    	};
	</script>
	<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data_penerangan = $.ajax({
            url : "<?php echo site_url('c_kecamatan/getpenerangan/'),$kode ?>",
            dataType : "json",
            async:false
        }).responseText;
        console.log(data_penerangan)
        
		var data = new google.visualization.DataTable(data_penerangan);

        var options = {
          title: 'Desa/Kelurahan berdasarkan penerangan jalan',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
	
	<script type="text/javascript">
		var kode = "<?php echo strval($kode) ?>"
		var data_indeks = $.ajax({
            url : "<?=base_url()?>c_kecamatan/getindeks",
            dataType : "json",
            async:false
		}).responseJSON

		console.log(data_indeks);

		
		var map = L.map('map').setView([-7.797068, 110.370529], 9.5);

		function resetHighlight(e) {
			layer.resetStyle(e.target);
			//info.update();
		}
		var layer = new L.GeoJSON.AJAX(["<?=base_url()?>assets/geojson/"+kode+"kec.geojson"], {
					style: style,
					onEachFeature: onEachFeaturekec
					//pointToLayer: featureToMarker
				}).addTo(map)
		
		function style(feature) {
			var kodekec = feature.properties.kabkotno;
			kodekec += feature.properties.kecno;
			return {
				weight: 0.5,
				opacity: 0.5,
				color: 'grey',
				dashArray: '5',
				fillOpacity: 0.8,
				fillColor: getColor(data_indeks[kodekec])
			};
		}
		function onEachFeaturekec(feature, layer) {
    		layer.on({
        		mouseover: highlightFeaturekec,
        		mouseout: resetHighlight,
        		click: zoomToFeature
    		});
		}
		function resetHighlight(e) {
			layer.resetStyle(e.target);
			//info.update();
		}
		function highlightFeaturekec(e) {
			var layer = e.target;

			layer.setStyle({
				weight: 5,
				color: 'green',
				dashArray: '',
				fillOpacity: 0.7
			});

			if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
				layer.bringToFront();
			}
			var kodekec = layer.feature.properties.kabkotno;
			kodekec += layer.feature.properties.kecno;
			var info = "Kecamatan :  " + layer.feature.properties.kecamatan + "<br>";
			info += "indeks sanitasi : "+ data_indeks[kodekec]+ "<br>";
			// info += "indeks_a : "+indeksa+"<br>";
			// info += "indeks_b : "+indeksb+"<br>";
			// info += "populasi : "+populasi+"<br>";

			layer.bindPopup(info, {
				maxWidth: 260,
				closButton: true,
				offset: L.point(0, -20)
			})
			e.target.openPopup();
			//info.update(layer.feature.properties);
		}
		var legend = L.control({
			position: 'bottomright'
		});

		legend.onAdd = function (map) {

			var div = L.DomUtil.create('div', 'info legend'),
				grades = [0,0.5, 1,1.5, 2,2.5, 3,3.5],
				labels = [],
				from, to;

			for (var i = 0; i < grades.length; i++) {
				from = grades[i];
				to = grades[i + 1];

				labels.push(
					'<i style="background:' + getColor(from + 1) + '"></i> ' +
					from + (to ? ' &ndash; ' + to : '+'));
			}

			div.innerHTML = labels.join('<br>');
			return div;
		};
		function getColor(d) {
			return d > 3.5 ? '#800026' :
			d > 3 ? '#BD0026' :
			d > 2.5 ? '#E31A1C' :
			d > 2 ? '#FC4E2A' :
			d > 1.5 ? '#FD8D3C' :
			d > 1 ? '#FEB24C' :
			d > 0.5 ? '#FED976' :
			'#FFEDA0';
		}

		legend.addTo(map);
		
		L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
			maxZoom: 18,
			id: 'mapbox/streets-v11',
			accessToken: 'your.mapbox.access.token'
		}).addTo(map);
		
	</script>

<footer class="nav navbar-inverse ">
		
		<ul style="text-align:center; color:white;"  class="nav navbar-nav navbar-left ">
                <li><a >M. Yoga Satria Utama </a></li>
                <li><a >Dea Aditia</a></li>
                <li><a >Hasran Nawira</a></li>
                <li><a >Pitta Hutagalung</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
                <li><a >&copy; Politeknik Statistika STIS    </a></li>
        </ul>
        
</footer>
</body>

</html>

