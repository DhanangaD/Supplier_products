<template>
    <div class="container">
        <input 
            v-model="search" 
            @input="fetchSuppliers" 
            placeholder="Search by Name or Mobile" 
            class="search-input"
        />
        <div v-for="supplier in suppliers" :key="supplier.id" class="supplier-card">
            <h3>{{ supplier.name }}</h3>
            <p>{{ supplier.contact_person }} - {{ supplier.mobile_numbers }}</p>
            <ul class="product-list">
                <li v-for="product in supplier.products" :key="product.id" class="product-item">
                    {{ product.product_name }} - ${{ product.product_price.toFixed(2) }}
                </li>
            </ul>
        </div>
        <div class="pagination">
            <button @click="previousPage" :disabled="!pagination.prev">Previous</button>
            <button @click="nextPage" :disabled="!pagination.next">Next</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            suppliers: [],
            search: '',
            pagination: {
                next: null,
                prev: null,
            },
        };
    },
    methods: {
        async fetchSuppliers(pageUrl = '/api/suppliers') {
            const response = await axios.get(pageUrl, {
                params: { search: this.search },
            });
            this.suppliers = response.data.data;
            this.pagination.next = response.data.next_page_url;
            this.pagination.prev = response.data.prev_page_url;
        },
        nextPage() {
            if (this.pagination.next) this.fetchSuppliers(this.pagination.next);
        },
        previousPage() {
            if (this.pagination.prev) this.fetchSuppliers(this.pagination.prev);
        },
    },
    mounted() {
        this.fetchSuppliers();
    },
};
</script>

<style scoped>
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.search-input {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.supplier-card {
    background-color: #fff;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 6px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
}

.supplier-card h3 {
    margin: 0 0 10px;
    color: #333;
}

.supplier-card p {
    margin: 0 0 10px;
    color: #555;
}

.product-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.product-item {
    padding: 8px;
    background-color: #f9f9f9;
    margin-bottom: 5px;
    border-radius: 4px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.pagination {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

button {
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    background-color: #007bff;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:disabled {
    background-color: #cccccc;
    cursor: not-allowed;
}

button:hover:enabled {
    background-color: #0056b3;
}
</style>