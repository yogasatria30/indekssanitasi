<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>

<head>

	<title>PSDD DI Yogyakarta</title>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<link rel="stylesheet" href="<?=base_url()?>assets/js/leaflet.css"/>
	<link rel="stylesheet" href="<?=base_url()?>assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.css" />


	<script src="<?=base_url()?>assets/js//leaflet.js"></script>
	<script src="<?=base_url()?>assets/js/leaflet.ajax.js"></script>
	<script src="<?=base_url()?>assets/js/function.js"></script>
	<script src="<?=base_url()?>assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>

	<style>
		#map {
			width: 100vw;
			height: 100%;
			
		}
		body,
		html {
			top: 0;
			margin: 0;
			scroll-behavior: smooth;
		}

		#map {
			position: fixed;
			width: 80%;
			height: 91.4%;
			border: 3px solid #73AD21;
			background: white;
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
			line-height: 18px;
			color: #555;
		}

		.legend i {
			width: 18px;
			height: 18px;
			float: left;
			margin-right: 8px;
			opacity: 0.7;
		}
	</style>


</head>

<body>
	<div id='header'></div>
	<div id='map'>
	</div>
	<script src="<?=base_url()?>assets/js/jquery.min.js"></script>
	<!-- <script type="text/javascript" src="zxc.js"></script> -->
	<script type="text/javascript">
		var kode = "<?php echo strval($kode) ?>"
		console.log(kode);
		
		var map = L.map('map').setView([-7.797068, 110.370529], 9.5);
		
		var layer = new L.GeoJSON.AJAX(["<?=base_url()?>assets/geojson/"+kode+"des.geojson"], {
					style: style,
					onEachFeature: onEachFeaturedes
					//pointToLayer: featureToMarker
				}).addTo(map)
	</script>
</body>

</html>

