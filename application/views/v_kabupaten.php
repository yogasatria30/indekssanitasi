<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div id='map'>
	</div>
	<script src="<?=base_url()?>assets/js/jquery.min.js"></script> 
	<!-- <script type="text/javascript" src="zxc.js"></script> -->
	<script type="text/javascript">
		var map = L.map('map').setView([-7.797068, 110.370529], 9.5);


		var legend = L.control({
			position: 'bottomright'
		});

		legend.onAdd = function (map) {

			var div = L.DomUtil.create('div', 'info legend'),
				grades = [0, 500, 2000, 4000, 6000, 8000, 10000, 12000],
				labels = [],
				from, to;

			for (var i = 0; i < grades.length; i++) {
				from = grades[i];
				to = grades[i + 1];

				labels.push(
					'<i style="background:' + getColor(from + 1) + '"></i> ' +
					from + (to ? '&ndash;' + to : '+'));
			}

			div.innerHTML = labels.join('<br>');
			return div;
		};

		legend.addTo(map);
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


var layer = new L.GeoJSON.AJAX(["<?=base_url()?>assets/geojson/diykab.geojson"], {
					style: style,
					onEachFeature: onEachFeaturekab
					//pointToLayer: featureToMarker
				}).addTo(map)

	function onEachFeaturekab(feature, layer) {
    layer.on({
        mouseover: highlightFeaturekab,
        mouseout: resetHighlight,
        click: zoomToFeature
    });
}
	function highlightFeaturekab(e) {
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
    var info = "Kab/Kot :  " + layer.feature.properties.KABKOT + "<br>";
    info += "<a href ='home/kecamatan/" + layer.feature.properties.KABKOTNO + "'>Peta Kecamatan</a>"
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
function resetHighlight(e) {
			layer.resetStyle(e.target);
			//info.update();
		}
	</script>


