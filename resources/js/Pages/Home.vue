<template>
    <div class="container mx-auto mt-10 px-4">
        <!-- Section Titre -->
        <section class="mb-8">
            <h1 class="text-3xl font-bold text-center text-gray-800">Tâches</h1>
        </section>
  
        <!-- Section Table des Tâches -->
        <section class="overflow-x-auto bg-white p-6 shadow-md rounded-lg mb-10">
            <div v-for="(userTasks, userName) in groupedTasks" :key="userName" class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ userName }}</h2>
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Nom de la tâche</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="task in userTasks" :key="task.id" class="border-t border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4 text-sm text-gray-700 border-r">{{ task.name }}</td>
                            <td class="py-3 px-4 text-sm text-gray-700">{{ task.description }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
  
        <!-- Section Table des Présences -->
        <section class="overflow-x-auto bg-white p-6 shadow-md rounded-lg">
              <div v-for="(dateGroup, date) in groupedPresences" :key="date" class="mb-6">
                  <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ new Date(date).toLocaleDateString() }}</h2>
                  <table class="min-w-full bg-white">
                      <thead class="bg-gray-200">
                          <tr>
                              <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Utilisateur</th>
                              <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Matin</th>
                              <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Midi</th>
                              <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Soir</th>
                          </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200">
                          <tr v-for="presence in dateGroup" :key="presence.id" class="hover:bg-gray-50">
                              <td class="py-3 px-4 text-sm text-gray-700 border-r">{{ presence.user.name }}</td>
                              <td :class="getClass(presence.morning)" class="py-3 px-4 text-sm text-gray-700 border-r">{{ presence.morning ? 'Présent' : 'Absent' }}</td>
                              <td :class="getClass(presence.noon)" class="py-3 px-4 text-sm text-gray-700 border-r">{{ presence.noon ? 'Présent' : 'Absent' }}</td>
                              <td :class="getClass(presence.evening)" class="py-3 px-4 text-sm text-gray-700 border-r">{{ presence.evening ? 'Présent' : 'Absent' }}</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
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
      computed: {
          groupedTasks() {
              return this.tasks.reduce((acc, task) => {
                  const userName = task.user ? task.user.name : 'Non assigné';
                  if (!acc[userName]) {
                      acc[userName] = [];
                  }
                  acc[userName].push(task);
                  return acc;
              }, {});
          },
          groupedPresences() {
              return this.presences.reduce((acc, presence) => {
                  const date = presence.date;
                  if (!acc[date]) {
                      acc[date] = [];
                  }
                  acc[date].push(presence);
                  return acc;
              }, {});
          }
      },
      methods: {
          reloadTasks() {
              Inertia.reload({ only: ['tasks'] });
          },
          unassignTask(taskId) {
              Inertia.post(`/tasks/${taskId}/unassign`).then(() => {
                  this.reloadTasks();
              });
          },
          getClass(isPresent) {
              return isPresent ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
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
  .bg-green-100 {
      background-color: #d1e7dd;
  }
  .text-green-800 {
      color: #0f5132;
  }
  .bg-red-100 {
      background-color: #f8d7da;
  }
  .text-red-800 {
      color: #842029;
  }
  </style>
  