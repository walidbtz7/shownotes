<template>
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                Les notes de : {{ semestre }}
                <button @click="downloadPDF" class="btn btn-sm btn-primary">telecharger les notes</button>
            </div>
        </div>
        <div class="card-body p-2" v-if="isEmpty === false">
            <Module v-for="(elements, nom) in modules" :key="nom" :nom="nom" :elements="elements" />
        </div>
        <div class="card-body" v-else>
            <h5 class="text-center">Pas de notes à ce moment !</h5>
        </div>
    </div>
</template>

<script>
import { computed, toRefs } from 'vue';
import Module from "./Module";
export default {
    name: "TableDeNotes",
    components: {
        Module
    },
    props: ['notes', 'semestre'],
    setup(props) {
        const notes = toRefs(props).notes;
        const modules = computed(() => {
            return _.groupBy(notes.value, (note) => note.module);
        })

        const isEmpty = computed(() => {
            return _.isEmpty(modules.value);
        })

        const downloadPDF = () => {
            axios({
                url: '/api_pdf', //your url
                method: 'GET',
                responseType: 'blob', // important
            }).then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'releve_de_notes.pdf'); //or any other extension
                document.body.appendChild(link);
                link.click();
            });
        }

        return {
            modules,
            downloadPDF,
            isEmpty
        }

    }
}
</script>

<style>

</style>