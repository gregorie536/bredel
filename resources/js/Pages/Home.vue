<template>
  <div class="container mx-auto mt-10 px-4">
      <!-- Section Titre -->
      <section class="mb-8">
          <h1 class="text-3xl font-bold text-center text-gray-800">Tâches</h1>
      </section>

      <!-- Section Table des Tâches -->
      <section class="overflow-x-auto bg-white p-6 shadow-md rounded-lg mb-10">
          <table class="min-w-full bg-white">
              <thead class="bg-gray-200">
                  <tr>
                      <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Nom de la tâche</th>
                      <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Description</th>
                      <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Utilisateur assigné</th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="task in tasks" :key="task.id" class="border-t border-gray-200 hover:bg-gray-50">
                      <td class="py-3 px-4 text-sm text-gray-700 border-r">{{ task.name }}</td>
                      <td class="py-3 px-4 text-sm text-gray-700 border-r">{{ task.description }}</td>
                      <td class="py-3 px-4 text-sm text-gray-700">{{ task.user ? task.user.name : 'Non assigné' }}</td>
                  </tr>
              </tbody>
          </table>
      </section>

      <!-- Section Table des Présences -->
      <section class="overflow-x-auto bg-white p-6 shadow-md rounded-lg">
          <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Présences</h2>
          <table class="min-w-full bg-white">
              <thead class="bg-gray-200">
                  <tr>
                      <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Utilisateur</th>
                      <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Matin</th>
                      <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Midi</th>
                      <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Soir</th>
                      <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Date</th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="presence in presences" :key="presence.id" class="border-t border-gray-200 hover:bg-gray-50">
                      <td class="py-3 px-4 text-sm text-gray-700 border-r">{{ presence.user.name }}</td>
                      <td class="py-3 px-4 text-sm text-gray-700 border-r">{{ presence.morning ? 'Présent' : 'Absent' }}</td>
                      <td class="py-3 px-4 text-sm text-gray-700 border-r">{{ presence.noon ? 'Présent' : 'Absent' }}</td>
                      <td class="py-3 px-4 text-sm text-gray-700 border-r">{{ presence.evening ? 'Présent' : 'Absent' }}</td>
                      <td class="py-3 px-4 text-sm text-gray-700">{{ new Date(presence.date).toLocaleDateString() }}</td>
                  </tr>
              </tbody>
          </table>
      </section>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
  props: {
      tasks: {
          type: Array,
          required: true,
          default: () => [],
      },
      presences: {
          type: Array,
          required: true,
          default: () => [],
      },
  },
  methods: {
      reloadTasks() {
          Inertia.reload({ only: ['tasks'] });
      },
      unassignTask(taskId) {
          Inertia.post(`/tasks/${taskId}/unassign`).then(() => {
              this.reloadTasks();
          });
      }
  },
  watch: {
      tasks: {
          handler(newVal) {
              console.log('Tâches mises à jour:', newVal);
          },
          deep: true
      },
      presences: {
          handler(newVal) {
              console.log('Présences mises à jour:', newVal);
          },
          deep: true
      }
  }
};
</script>

<style scoped>
.container {
  margin-top: 20px;
}
</style>
