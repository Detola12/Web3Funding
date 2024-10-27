<template>
    <AuthenticatedLayout>
        <template #header class="flex">
            <PageHeader class="flex justify-between">
                <p>Show Campaigns</p>
                <Link :href="route('campaigns.create')"
                      class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 border border-transparent rounded-md hover:bg-gray-700">
                    Create Campaigns
                </Link>
            </PageHeader>
        </template>

        <BodyCard>
            <ul class="grid grid-cols-2 md:grid-cols-3 gap-8">
                <li v-for="campaign in campaigns" href="#" class="flex flex-col justify-between block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray/20">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ campaign.title }}</h5>
                    <p class="font-normal text-gray-700 ">{{ campaign.description }}</p>
                    <div class="mt-2">
                        <p class="font-normal text-gray-700 "><span class="text-green-600">Target:</span> <span class="font-bold">{{ campaign.goal_amount }}</span></p>
                        <p class="font-normal text-gray-700 "><span class="text-amber-500">Current:</span> <span class="font-bold">{{ campaign.current_amount }}</span></p>
                    </div>

                    <Link :href="route('campaigns.show', campaign.id)" class="mt-3 w-1/2 ms-auto items-center px-3 py-2 text-xs font-semibold tracking-widest
                     text-white uppercase bg-gray-800 border border-transparent rounded-md hover:bg-gray-700">
                        Contribute
                    </Link>
                </li>
            </ul>

        </BodyCard>
        <div class="relative z-10" :class="showModal === true ? 'block' : 'hidden'" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!--
              Background backdrop, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <!--
                      Modal panel, show/hide based on modal state.

                      Entering: "ease-out duration-300"
                        From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        To: "opacity-100 translate-y-0 sm:scale-100"
                      Leaving: "ease-in duration-200"
                        From: "opacity-100 translate-y-0 sm:scale-100"
                        To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    -->
                    <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Deactivate account</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Are you sure you want to deactivate your account? All of your data will be permanently removed. This action cannot be undone.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Deactivate</button>
                            <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--        <div class="max-w-4xl mx-auto p-6">
                    <h1 class="text-3xl font-bold mb-4">Campaigns</h1>
                    <div v-if="campaigns.length === 0" class="text-center">
                        <p>No campaigns available.</p>
                    </div>
                    <ul class="space-y-4">
                        <li v-for="campaign in campaigns" :key="campaign.id" class="p-4 border rounded-lg bg-gray-50">
                            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow bg-gray-800 border-gray-700">
                                <a href="#">
                                    <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
                                </a>
                                <div class="p-5">
                                    <a href="#">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 text-white">Noteworthy technology acquisitions 2021</h5>
                                    </a>
                                    <p class="mb-3 font-normal text-gray-700 text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">
                                        Read more
                                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </li>
                        <li v-for="campaign in campaigns" :key="campaign.id" class="p-4 border rounded-lg bg-gray-50">
                            <h2 class="text-xl font-semibold">{{ campaign.title }}</h2>
                            <p>{{ campaign.description }}</p>
                            <p><strong>Goal Amount:</strong> {{ campaign.goal_amount }} ETH</p>
                            <p><strong>Wallet Address:</strong> {{ campaign.wallet_address }}</p>
                            <p><strong>Deadline:</strong> {{ new Date(campaign.deadline).toLocaleDateString() }}</p>
                            <Link :href="`/campaigns/${campaign.id}`" class="text-blue-500 hover:underline">View Details</Link>
                        </li>
                    </ul>
                </div>-->
    </AuthenticatedLayout>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import {defineProps, ref} from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import BodyCard from "@/Components/BodyCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ethers} from "ethers";

defineProps({
    campaigns: Array,
})

let showModal = false

let connectWallet = async () => {
    if (typeof window.ethereum !== 'undefined') {
        // Request account access if needed
        try {
            const accounts = await window.ethereum.request({
                method: "eth_requestAccounts",
            });
            // Create an ethers provider
            const provider = new ethers.BrowserProvider(window.ethereum);
            // Get the signer
            const signer = provider.getSigner();

            // Store the user's account address
            userAddress.value = accounts[0];


            console.log("Connected:", userAddress.value);
        } catch (error) {
            console.error("User denied account access or error occurred", error);
        }
    } else {
        console.error("Please install MetaMask!");
    }
};

let userAddress = ref(null);
let campaignId = ref(null);


const pledgeToCampaign = async () => {
    await connectWallet()
    const contractAddress = "0x5fbdb2315678afecb367f032d93f642f64180aa3"; // Replace with your contract address
    const contractABI = [
        {
            "anonymous": false,
            "inputs": [
                {
                    "indexed": false,
                    "internalType": "uint256",
                    "name": "id",
                    "type": "uint256"
                },
                {
                    "indexed": false,
                    "internalType": "address",
                    "name": "owner",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "internalType": "uint256",
                    "name": "goal",
                    "type": "uint256"
                }
            ],
            "name": "CampaignCreated",
            "type": "event"
        },
        {
            "anonymous": false,
            "inputs": [
                {
                    "indexed": false,
                    "internalType": "uint256",
                    "name": "id",
                    "type": "uint256"
                },
                {
                    "indexed": false,
                    "internalType": "address",
                    "name": "contributor",
                    "type": "address"
                },
                {
                    "indexed": false,
                    "internalType": "uint256",
                    "name": "amount",
                    "type": "uint256"
                }
            ],
            "name": "PledgeReceived",
            "type": "event"
        },
        {
            "inputs": [],
            "name": "campaignCount",
            "outputs": [
                {
                    "internalType": "uint256",
                    "name": "",
                    "type": "uint256"
                }
            ],
            "stateMutability": "view",
            "type": "function"
        },
        {
            "inputs": [
                {
                    "internalType": "uint256",
                    "name": "",
                    "type": "uint256"
                }
            ],
            "name": "campaigns",
            "outputs": [
                {
                    "internalType": "address payable",
                    "name": "owner",
                    "type": "address"
                },
                {
                    "internalType": "uint256",
                    "name": "goal",
                    "type": "uint256"
                },
                {
                    "internalType": "uint256",
                    "name": "pledged",
                    "type": "uint256"
                },
                {
                    "internalType": "bool",
                    "name": "completed",
                    "type": "bool"
                }
            ],
            "stateMutability": "view",
            "type": "function"
        },
        {
            "inputs": [
                {
                    "internalType": "uint256",
                    "name": "_goal",
                    "type": "uint256"
                }
            ],
            "name": "createCampaign",
            "outputs": [],
            "stateMutability": "nonpayable",
            "type": "function"
        },
        {
            "inputs": [
                {
                    "internalType": "uint256",
                    "name": "_id",
                    "type": "uint256"
                }
            ],
            "name": "getCampaign",
            "outputs": [
                {
                    "components": [
                        {
                            "internalType": "address payable",
                            "name": "owner",
                            "type": "address"
                        },
                        {
                            "internalType": "uint256",
                            "name": "goal",
                            "type": "uint256"
                        },
                        {
                            "internalType": "uint256",
                            "name": "pledged",
                            "type": "uint256"
                        },
                        {
                            "internalType": "bool",
                            "name": "completed",
                            "type": "bool"
                        }
                    ],
                    "internalType": "struct Crowdfunding.Campaign",
                    "name": "",
                    "type": "tuple"
                }
            ],
            "stateMutability": "view",
            "type": "function"
        },
        {
            "inputs": [
                {
                    "internalType": "uint256",
                    "name": "_id",
                    "type": "uint256"
                }
            ],
            "name": "pledge",
            "outputs": [],
            "stateMutability": "payable",
            "type": "function"
        }
    ]

    if (!userAddress.value) {
        console.error("Please connect your wallet first!");
        return;
    }

    try {
        const provider = new ethers.BrowserProvider(window.ethereum);
        const signer = provider.getSigner();
        const contract = new ethers.Contract(contractAddress, contractABI, signer);

        // Pledge to the campaign
        let pledgeAmount = ref(0)
        const tx = await contract.pledge(campaignId.value, { value: ethers.parseEther(pledgeAmount.value.toString()) });
        await tx.wait(); // Wait for the transaction to be mined

        console.log("Pledge successful:", tx);
    } catch (error) {
        console.error("Error pledging to campaign:", error);
    }
};
</script>
