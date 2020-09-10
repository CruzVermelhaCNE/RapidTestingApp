<template>
  <div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nome</label>
      <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="name"
        type="text"
        placeholder="Nome"
        v-model="name"
      />
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="sns">SNS</label>
      <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="sns"
        type="text"
        placeholder="SNS"
        v-model="sns"
      />
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="date_time">Data e Hora</label>
      <div class="inline-block relative w-full">
        <select
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          v-model="id"
        >
          <option
            :disabled="schedule.slots === 0"
            :key="schedule.id"
            :value="schedule.id"
            v-for="schedule in this.$root.$data.schedules"
          >
            {{schedule.time}} {{schedule.date}} ({{schedule.slots}}
            <span
              v-if="schedule.slots === 1"
            >Vaga</span>
            <span v-else>Vagas</span>)
          </option>
        </select>
        <div
          class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
        >
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
          </svg>
        </div>
      </div>
    </div>
    <div class="flex md:flex-row-reverse flex-wrap">
      <button
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        type="button"
        @click="save"
      >Marcar</button>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    console.log(this.$root.$data.schedules);
    this.timer = setInterval(this.fetchSchedules, 5000);
  },
  data() {
    return { timer: "", id: 0, name: "", sns: "" };
  },
  methods: {
    save() {
      this.$root.$data.state = 3;
      axios
        .post("/api/location/schedules/appointment", {
          code: this.$root.$data.code,
          id: this.id,
          name: this.name,
          sns: this.sns,
        })
        .then(
          function (response) {
            const schedule = this.$root.$data.schedules.filter((val) => {
              return val.id == this.id;
            })[0];
            console.log(schedule);
            this.$root.$data.appointment = schedule;
            this.$root.$data.alert = null;
            this.cancelAutoUpdate();
          }.bind(this)
        ).catch(
          function (error) {
            this.$root.$data.alert = "Erro ao criar Marcação. Por favor tente de novo";
          }.bind(this)
        );
    },
    fetchSchedules() {
      axios
        .post("/api/location/schedules", {
          code: this.$root.$data.code,
        })
        .then(
          function (response) {
            this.$root.$data.schedules = response.data;
          }.bind(this)
        )
        .catch(
          function (error) {
            this.$root.$data.alert = "Código de Marcação Errado";
            this.$root.$data.schedules = [];
          }.bind(this)
        );
    },
    cancelAutoUpdate() {
      clearInterval(this.timer);
    },
  },
  beforeDestroy() {
    clearInterval(this.timer);
  },
};
</script>

<style scoped>
select option:disabled {
  background-color: #e9ecef;
}
</style>