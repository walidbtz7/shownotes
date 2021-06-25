<template>
  <div class="mb-5 d-flex align-items-center justify-content-between">
    <h1 class="display-4">Bonjour {{ nom }}</h1>
    <div class="dropdown">
      <button
        class="btn btn-lg btn-success dropdown-toggle"
        type="button"
        id="dropdownMenuButton"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
      >
        Semestre {{ semestre }}
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" @click.prevent="semestre = 's1'">Semestre 1</a>
        <a class="dropdown-item" @click.prevent="semestre = 's2'">Semestre 2</a>
        <a class="dropdown-item" @click.prevent="semestre = 's3'">Semestre 3</a>
        <a class="dropdown-item" @click.prevent="semestre = 's4'">Semestre 4</a>
      </div>
    </div>
  </div>
  <TableDeNotes :notes="notes" :semestre="semestre" />
</template>

<script>
import TableDeNotes from "./TableDeNotes";
import axios from "axios";
import { computed, ref } from "vue";
export default {
  name: "App",
  props: ["nom"],
  components: {
    TableDeNotes,
  },
  setup() {
    const semestre = ref("s1");
    const data = ref([]);
    const notes = computed(() => {
      return _.filter(data.value, (note) => note.semestre === semestre.value);
    });

    const getNotes = async () => {
      try {
        const res = await axios.get("/api_notes");
        data.value = res.data;
      } catch (error) {
        console.log("Error", error);
      }
    };

    getNotes();

    return {
      semestre,
      notes,
    };
  },
};
</script>

<style scoped></style>
