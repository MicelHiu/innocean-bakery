<script setup>
defineProps({
    submissions: { type: Array, default: () => [] },
    loading: Boolean,
    error: String,
});

const formatDate = (value) => value ? new Date(value).toLocaleString('id-ID', {dateStyle: 'medium', timeStyle: 'short'}) : '-';
</script>

<template>
    <section class="border border-grid bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-grid bg-excel-light px-5 py-3">
            <h2 class="text-sm font-semibold uppercase tracking-wide text-excel-dark">Submitted Data</h2>
            <span class="text-xs text-excel-dark">{{ submissions.length }} rows</span>
        </div>

        <p v-if="error" class="px-5 py-6 text-sm text-red-700">{{ error }}</p>
        <p v-else-if="loading" class="px-5 py-6 text-sm text-slate-500">Loading...</p>
        <p v-else-if="!submissions.length" class="px-5 py-6 text-sm text-slate-500">
            No data yet. Fill in the form to add the first entry.
        </p>

        <div v-else class="overflow-x-auto">
            <table class="w-full border-collapse text-sm">
                <thead>
                    <tr class="bg-excel text-center text-white">
                        <th class="w-12 border border-excel-dark px-3 py-2">#</th>
                        <th class="border border-excel-dark px-3 py-2">Name</th>
                        <th class="border border-excel-dark px-3 py-2">Store</th>
                        <th class="border border-excel-dark px-3 py-2">Product</th>
                        <th class="border border-excel-dark px-3 py-2">Submitted</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(s, i) in submissions"
                        :key="s.id"
                        class="odd:bg-white even:bg-sheet hover:bg-excel-light"
                    >
                        <td class="border border-grid bg-sheet px-3 py-2 text-center text-slate-500">{{ i + 1 }}</td>
                        <td class="border border-grid px-3 py-2">{{ s.name }}</td>
                        <td class="border border-grid px-3 py-2">{{ s.store }}</td>
                        <td class="border border-grid px-3 py-2">{{ s.product }}</td>
                        <td class="whitespace-nowrap border border-grid px-3 py-2 text-slate-500 text-center">
                            {{ formatDate(s.created_at) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>