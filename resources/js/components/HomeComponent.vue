<template>
    <div style="height: 100%; width: 100%">
        <l-map
            :zoom="zoom"
            :center="center"
            @update:zoom="zoomUpdated"
            @update:center="centerUpdated"
            @update:bounds="boundsUpdated"
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
                zoom: 14,
                center: [44.616604, 33.525369],
                bounds: null
            };
        },
        methods: {
            zoomUpdated (zoom) {
                this.zoom = zoom;
            },
            centerUpdated (center) {
                this.center = center;
            },
            boundsUpdated (bounds) {
                this.bounds = bounds;
            }
        },
        props: {
            options: {
                type: Object,
                default: () => ({})
            }
        }
    }
</script>
