<template>
    <AuthenticatedLayout>
        <template #header>
            <PageHeader>
                Show Campaign
            </PageHeader>
        </template>
        <BodyCard>
            <h1 class="text-3xl font-bold mb-4">{{ campaign.title }}</h1>
            <p class="mb-4">{{ campaign.description }}</p>
            <p class="font-semibold">Goal Amount: {{ campaign.goal_amount }} ETH</p>
            <p class="font-semibold">Current Amount: {{ campaign.current_amount }} ETH</p>
            <p class="font-semibold">Wallet Address: {{ campaign.wallet_address }}</p>
            <p class="font-semibold">Deadline: {{ new Date(campaign.deadline).toLocaleDateString() }}</p>

            <!-- Contribution Form -->
            <form @submit.prevent="submit(campaign.id)" class="mt-6 space-y-4">
                <h2 class="text-2xl font-semibold">Make a Contribution</h2>
                <div>
                    <InputLabel for="amount" class="block font-semibold">Amount (ETH)</InputLabel>
                    <TextInput v-model="form.amount" step="0.01" required class="w-full p-2 border rounded" />
                </div>
                <button @click="submit(campaign.id)" class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Contribute
                </button>
            </form>

            <!-- Contributions Section -->
            <div class="mt-6">
                <h2 class="text-2xl font-semibold">Contributions</h2>
                <ul v-if="campaign.contributions.length > 0" class="space-y-2">
                    <li v-for="contribution in campaign.contributions" :key="contribution.id" class="p-2 border rounded">
                        <p><strong>Amount:</strong> {{ contribution.amount }} ETH</p>
                        <p><strong>Wallet Address:</strong> {{ contribution.contributor }}</p>
                        <p><strong>Date:</strong> {{ new Date(contribution.created_at).toLocaleDateString() }}</p>
                    </li>
                </ul>
                <p v-else>No contributions yet.</p>
            </div>

        </BodyCard>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import BodyCard from "@/Components/BodyCard.vue";
import {useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    campaign: Object
})

let form = useForm({
    'amount' : '',
})

let submit = (id) => {
    form.post(route('campaigns.contribute', id))
}

</script>
