<template>
  <div class="mb-3">
        <h4 class="my-2">Module de {{ nom }} : 
            <span v-if="moyenne < 12" class="text-danger">{{ moyenne }} non validé</span>
            <span v-else class="text-success">{{ moyenne }} validé</span>
        </h4>
        <table class="table m-0 border">
            <thead>
                <tr class="table-head">
                    <th scope="col">element</th>
                    <th scope="col">controle</th>
                    <th scope="col">exam</th>
                    <th scope="col">moyenne</th>
                </tr>
            </thead>
            <tbody>
                <Element v-for="element in elements" :key="element.element" :element="element" />
            </tbody>
        </table>
    </div>
</template>

<script>
import { computed, toRefs } from 'vue';
import Element from "./Element";
export default {
    name: "Module",
    props: ['nom', 'elements'],
    components : {
        Element
    },
    setup(props) {
        const elements = toRefs(props).elements;
        const moyenne = computed(() => {
            const moyennes_des_notes = elements.value.map(item => (item.controle * 0.4) + (item.exam * 0.6));

            return _.round(_.mean(moyennes_des_notes), 2);
        })

        return {
            moyenne
        }
    }

}
</script>

<style>

</style>