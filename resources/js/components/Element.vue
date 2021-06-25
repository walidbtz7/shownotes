<template>
    <tr>
        <th>{{ element.element }}</th>
        <th>{{ element.controle }}</th>
        <th>{{ element.exam }}</th>
        <td>{{ moyenne }}</td>
    </tr>
</template>

<script>
import { computed, toRefs } from 'vue'
export default {
    name: "Element",
    props: ['element'],
    setup(props) {
        const data = toRefs(props).element;
        const moyenne = computed(() => {
            return _.round((data.value.controle * 0.4) + (data.value.exam * 0.6), 2) ;
        })

        return {
            moyenne
        }
    }
}
</script>

<style>

</style>