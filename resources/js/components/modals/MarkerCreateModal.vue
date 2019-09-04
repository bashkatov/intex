<template>
    <modal name="marker-create" transition="pop-out" @before-open="catchParams" @before-close="clearForm">
        <div class="flex mb-4">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Описание
                    </label>
                    <textarea v-model="comment" class="w-full border border-gray-300 rounded p-2 text-black"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Укажите категории
                    </label>
                    <multiselect v-model="types"
                                 placeholder="Искать категорию"
                                 selectLabel="Нажмите Enter для подтверждения"
                                 deselectLabel="Нажмите Enter для удаления"
                                 label="name"
                                 track-by="name"
                                 :options="categories"
                                 :multiple="true">
                    </multiselect>
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

    import Multiselect from 'vue-multiselect'

    export default {
        name: 'MarkerCreateModal',
        components: {Multiselect},
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

