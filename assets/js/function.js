function style(feature) {
    return {
        weight: 2,
        opacity: 1,
        color: 'gray',
        dashArray: '3',
        fillOpacity: 0.7,
    };
}


function highlightFeaturedes(e) {
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
    var kode = layer.feature.properties.kabkotno;
    kode += layer.feature.properties.kecno;
    var data = "Kecamatan :  " + layer.feature.properties.desa + "<br>";
    data += "<a href ='../../home/desa/" + kode.toString() + "'>Peta Desa</a>"
    // info += "indeks_a : "+indeksa+"<br>";
    // info += "indeks_b : "+indeksb+"<br>";
    // info += "populasi : "+populasi+"<br>";

    layer.bindPopup(data, {
        maxWidth: 260,
        closButton: true,
        offset: L.point(0, -20)
    })
    e.target.openPopup();
    //info.update(layer.feature.properties);
}



function zoomToFeature(e) {
    //e.target.openPopup();
    map.fitBounds(e.target.getBounds());

}




function onEachFeaturedes(feature, layer) {
    layer.on({
        mouseover: highlightFeaturedes,
        mouseout: resetHighlight,
        click: zoomToFeature
    });
}

function onEachFeature1(feature, layer) {

    // var fid = feature.properties.KABKOT;

    // $.getJSON("<?=base_url()?>home/data/" + fid, function (data) {
    //     var indeksa = data[0].indeks_a;
    //     var indeksb = data[0].indeks_b;
    //     var populasi = data[0].populasi;

    //     var info = "Desa " + feature.properties.KABKOT + "<br>";
    //     info += "indeks_a : " + indeksa + "<br>";
    //     info += "indeks_b : " + indeksb + "<br>";
    //     info += "populasi : " + populasi + "<br>";
    //     info += "<a href ='<?=base_url()?>home/detail/" + fid + "'>DETAIL</a>"

    //     layer.bindPopup(info, {
    //         maxWidth: 260,
    //         closButton: true,
    //         offset: L.point(0, -20)
    //     })
    // });
    layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: zoomToFeature
    });
}

function iconByName(name) {
    return '<i class="icon" style="background-color:' + name + ';border-radius:50%"></i>';
}

function featureToMarker(feature, latlng) {
    return L.marker(latlng, {
        icon: L.divIcon({
            className: 'marker-' + feature.properties.amenity,
            html: iconByName(feature.properties.amenity),
            iconUrl: '../images/markers/' + feature.properties.amenity + '.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        })
    });
}