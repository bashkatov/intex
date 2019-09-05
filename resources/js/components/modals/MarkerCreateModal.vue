<template>
    <modal name="marker-create" transition="pop-out" @before-open="catchParams" @before-close="clearForm"
           :adaptive="true" width="50%" height="50%">
        <div class="flex mb-4">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full h-screen">
                <div class="pb-3">
                    <p class="text-2xl font-bold">Новый маркер</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Укажите категории
                    </label>
                    <v-select multiple v-model="types" :options="categories" label="name" class="style-chooser"/>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Описание
                    </label>
                    <textarea v-model="comment" class="w-full border border-gray-300 rounded p-2 text-black"></textarea>
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                        type="button" @click="hide">
                        Отмена
                    </button>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="button"
                            @click="saveMarker">
                        Сохранить
                    </button>
                </div>
            </form>
        </div>
    </modal>
</template>
<script>

    export default {
        name: 'MarkerCreateModal',
        data () {
            return {
                types: null,
                categories: null,
                comment: null,
                latitude: null,
                longitude: null,
            }
        },
        created () {
            this.getTypes()
        },
        methods: {
            catchParams (event) {
                this.latitude = event.params.latitude
                this.longitude = event.params.longitude
            },
            saveMarker () {
                axios.post('/api/markers', {
                    types: this.$_.map(this.types, 'id'),
                    comment: this.comment,
                    latitude: this.latitude,
                    longitude: this.longitude,
                }).then(res => {
                    console.log(res)
                    this.$parent.addMarker(res.data.feature)
                    // this.$parent.requestMarkers()
                    this.hide()
                }).catch(error => {
                    console.log(error)
                })
            },
            clearForm (event) {
                this.comment = null
                this.latitude = null
                this.longitude = null
                this.types = []
            },
            hide () {
                this.$modal.hide('marker-create')
            },
            getTypes () {
                axios.get('/api/types').then((response) => {
                    this.categories = response.data
                }).catch((error) => {
                    console.log(error.response)
                })
            },
        },

    }
</script>
