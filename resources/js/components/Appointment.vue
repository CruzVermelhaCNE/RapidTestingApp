<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <AppointmentLogo />

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
      <h4 class="text-xl text-gray-900 leading-tight text-center">Marcações</h4>
      <AppointmentAlert v-if="this.$root.$data.alert !== null" />
      <AppointmentAuthenticator v-if="this.$root.$data.schedules === null && this.$root.$data.appointment === null" />
      <AppointmentRegistration v-if="this.$root.$data.schedules !== null && this.$root.$data.appointment === null" />
      <AppointmentThankYou v-if="this.$root.$data.appointment !== null" />
    </div>
    <p
      class="text-center text-gray-500 text-xs"
    >&copy;2020 Cruz Vermelha Portuguesa. Todos os Direitos Reservados</p>
  </div>
</template>

<script>
import AppointmentLogo from "./AppointmentLogo.vue";
import AppointmentAlert from "./AppointmentAlert.vue";
import AppointmentAuthenticator from "./AppointmentAuthenticator.vue";
import AppointmentRegistration from "./AppointmentRegistration.vue";
import AppointmentThankYou from "./AppointmentThankYou.vue";

export default {
  components: {
    AppointmentLogo,
    AppointmentAlert,
    AppointmentAuthenticator,
    AppointmentRegistration,
    AppointmentThankYou,
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
