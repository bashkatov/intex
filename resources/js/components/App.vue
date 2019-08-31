<template>
    <div style="height: 100%; width: 100%">
        <l-map
            ref="map"
            :zoom="zoom"
            :center="center"
            @update:zoom="zoomUpdated"
            @update:center="centerUpdated"
        >
            <l-tile-layer :url="url"></l-tile-layer>
        </l-map>
    </div>
</template>

<script>

    export default {
        data () {
            return {
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                zoom: 5,
                center: [44.616604, 33.525369],
                bounds: null,
                markers: {}
            }
        },
        watch: {
            bounds: {
                handler: 'requestMarkers',
            },
            markers: {
                handler: 'drawMarkers',
            },
        },
        mounted () {
            this.bounds = this.calculateBounds()
        },
        updated () {
            this.bounds = this.calculateBounds()
        },
        methods: {
            zoomUpdated (zoom) {
                this.zoom = zoom
            },
            centerUpdated (center) {
                this.center = center
            },
            calculateBounds () {
                let map = this.$refs.map.mapObject
                return map.getBounds().toBBoxString()
            },
            drawMarkers () {
                let map = this.$refs.map.mapObject
                let geojsonMarkerOptions = {
                    radius: 6,
                    fillColor: '#00ff05',
                    color: '#000',
                    weight: 1,
                    opacity: 1,
                    fillOpacity: 0.8,
                }
                L.geoJSON(this.markers, {
                    pointToLayer: function (feature, latlng) {
                        return L.circleMarker(latlng, geojsonMarkerOptions)
                    },
                    onEachFeature: function onEachFeature (feature, layer) {
                        layer.bindPopup(feature.properties.comment)
                    },
                }).addTo(map)
            },
            requestMarkers () {
                console.log(this.bounds)
                axios.get('/api/markers?bbox=' + this.bounds).then((response) => {
                    this.markers = response.data
                }).catch((error) => {
                    console.log(error.response)
                })
            },
        },
    }
</script>
