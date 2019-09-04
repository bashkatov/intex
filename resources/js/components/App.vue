<template>
    <div style="height: 100%; width: 100%">
        <l-map
            ref="map"
            :zoom="zoom"
            :center="center"
            @update:zoom="zoomUpdated"
            @update:center="centerUpdated"
            @click="handleMapClick"
        >
            <l-tile-layer :url="url"></l-tile-layer>
            <l-geo-json :geojson="geojson" :options="mapOptions"></l-geo-json>
        </l-map>
        <marker-create/>
    </div>
</template>

<script>
    import MarkerCreate from './modals/MarkerCreateModal'

    export default {
        data () {
            return {
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                zoom: 5,
                center: [44.616604, 33.525369],
                bounds: null,
                geojson: [],
                mapOptions: this.getMapOptions(),
                types: null,
            }
        },
        components: {
            MarkerCreate,
        },
        watch: {
            bounds: {
                handler: 'requestMarkers',
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
            getMapOptions () {
                return {
                    onEachFeature: function onEachFeature (feature, layer) {
                        let created_date = '<p><strong>Создано:</strong> ' + feature.properties.created_date + '</p>'
                        let types = '<p><strong>Категории:</strong> ' +
                            _.join(_.map(feature.properties.types, 'name'), ', ') + '</p>'
                        layer.bindPopup(created_date + feature.properties.comment + types)
                    },

                }
            },
            requestMarkers () {
                axios.get('/api/markers?bbox=' + this.bounds).then((response) => {
                    this.geojson = response.data
                }).catch((error) => {
                    console.log(error.response)
                })
            },
            addMarker (feature) {
                this.geojson.features.push({...feature})
            },
            handleMapClick (event) {
                this.$modal.show('marker-create', {latitude: event.latlng.lat, longitude: event.latlng.lng})
            },
            hide () {
                this.$modal.hide('marker-create')
            },
        },
    }
</script>
