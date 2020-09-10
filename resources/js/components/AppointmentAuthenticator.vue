<template>
  <div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="code">Código de Marcação</label>
      <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="code"
        type="text"
        placeholder="Código de Marcação"
        v-model="code"
      />
    </div>
    <div class="flex md:flex-row-reverse flex-wrap">
      <button
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        type="button"
        @click="verify"
      >Verificar</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return { code: "" };
  },
  methods: {
    verify() {
      let that = this;
      axios.post("/api/location/schedules", {
          code: this.code,
        })
        .then(function (response) {
          this.$root.$data.code = this.code;
          this.$root.$data.schedules = response.data;
          this.$root.$data.alert = null;
        }.bind(this))
        .catch(function (error) {
          this.$root.$data.alert = "Código de Marcação Errado";
        }.bind(this));
    },
  },
};
</script>