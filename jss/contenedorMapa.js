
window.onload = init;

function init(){
    const map = new OpenLayers.Map({
        view: new OpenLayers.View({
            center: [0, 0],
            zoom: 2
        }),
        layers: [
            new OpenLayers.layer.Tile({
                source: new OpenLayers.source.OSM()
            })
        ],
        target: 'map'
    })
}

