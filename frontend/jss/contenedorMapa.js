
// window.onload = init;

// function init(){
//     const map = new OpenLayers.Map({
//         view: new OpenLayers.View({
//             center: [0, 0],
//             zoom: 2
//         }),
//         layers: [
//             new OpenLayers.layer.Tile({
//                 source: new OpenLayers.source.OSM()
//             })
//         ],
//         target: 'map'
//     })
// }

var layer = new ol.layer.Tile({
    source: new ol.source.OSM()
});

var honduras = new ol.proj.transform(
    [-87.2167, 14.1],
    'ESPG:4326',
    'ESPG:3857'
);

var view = new ol.View({
    center: honduras,
    zoom: 10
});

var map = new ol.Map({
    target: document.getElementById('map'),
    layers: [layer],
    view: view
});
