<template>
    <div class="container mx-auto mt-10 px-4">
        <!-- Section Titre -->
        <section class="mb-8">
            <h1 class="text-3xl font-bold text-center text-gray-800">Présences</h1>
        </section>

        <!-- Onglets -->
        <div class="flex justify-center gap-4 mb-4">
            <button class="px-4 py-2 text-white bg-blue-500 rounded-lg shadow hover:bg-blue-600 transition-colors"
                @click="retour">Retour</button>
        </div>

        <!-- Section Table des Présences -->
        <section class="overflow-x-auto bg-white p-6 shadow-md rounded-lg mb-10">
            <div v-for="(dateGroup, date) in groupedPresences" :key="date" class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ new Date(date).toLocaleDateString() }}</h2>
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Utilisateur
                            </th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Matin</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Midi</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Soir</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="presence in dateGroup" :key="presence.id" class="hover:bg-gray-50">
                            <td class="py-3 px-4 text-sm text-gray-700 border-r">{{ presence.user.name }}</td>
                            <td :class="getClass(presence.morning)" class="py-3 px-4 text-sm text-gray-700 border-r">{{
                                presence.morning ? 'Présent' : 'Absent' }}</td>
                            <td :class="getClass(presence.noon)" class="py-3 px-4 text-sm text-gray-700 border-r">{{
                                presence.noon ? 'Présent' : 'Absent' }}</td>
                            <td :class="getClass(presence.evening)" class="py-3 px-4 text-sm text-gray-700 border-r">{{
                                presence.evening ? 'Présent' : 'Absent' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Section Table des Présences des Enfants -->
        <section class="overflow-x-auto bg-white p-6 shadow-md rounded-lg">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Présences des Enfants</h2>
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Présence</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600 border-r">Enfants</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr v-for="(children, presence) in groupedChildPresences" :key="presence" class="hover:bg-gray-50">
                        <td class="py-3 px-4 text-sm text-gray-700 border-r">{{ presence ? 'Présents' : 'Absents' }}
                        </td>
                        <td :class="getClass(presence)" class="py-3 px-4 text-sm text-gray-700 border-r">{{
                            children.length }}</td>
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
        presences: {
            type: Array,
            required: true,
            default: () => [],
        },
        childPresences: {
            type: Array,
            required: true,
            default: () => [],
        }
    },
    computed: {
        groupedPresences() {
            return this.presences.reduce((acc, presence) => {
                const date = presence.date;
                if (!acc[date]) {
                    acc[date] = [];
                }
                acc[date].push(presence);
                return acc;
            }, {});
        },
        groupedChildPresences() {
            return this.childPresences.reduce((acc, presence) => {
                if (!acc[presence.present]) {
                    acc[presence.present] = [];
                }
                acc[presence.present].push(presence.child);
                return acc;
            }, {});
        }
    },
    methods: {
        getClass(isPresent) {
            return isPresent ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
        },
        retour() {
            window.history.back();
        }
    },
    watch: {
        presences: {
            handler(newVal) {
                console.log('Présences mises à jour:', newVal);
            },
            deep: true
        },
        childPresences: {
            handler(newVal) {
                console.log('Présences des enfants mises à jour:', newVal);
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
