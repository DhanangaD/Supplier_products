<template>
    <div class="form-container">
        <form @submit.prevent="addSupplier">
            <input v-model="supplier.name" placeholder="Supplier Name" required />
            <input v-model="supplier.contact_person" placeholder="Contact Person" required />
            <input v-model="supplier.mobile_numbers" placeholder="Mobile Numbers" required />

            <div v-for="(product, index) in products" :key="index" class="product-item">
                <input v-model="product.product_name" placeholder="Product Name" required />
                <input v-model="product.product_price" type="number" placeholder="Product Price" required />
                <input v-model="product.expired_date" type="date" placeholder="Expired Date" required />
                <input v-model="product.image" placeholder="Image URL" required />
            </div>

            <button type="button" @click="addProduct">Add Product</button>
            <button type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            supplier: {
                name: '',
                contact_person: '',
                mobile_numbers: '',
            },
            products: [
                { product_name: '', product_price: 0, expired_date: '', image: '' },
            ],
        };
    },
    methods: {
        addProduct() {
            this.products.push({ product_name: '', product_price: 0, expired_date: '', image: '' });
        },
        async addSupplier() {
            try {
                await axios.post('http://localhost:8000/suppliers', { ...this.supplier, products: this.products });
                
                // Log supplier and products data to console
                console.log('Supplier:', this.supplier);
                console.log('Products:', this.products);
                
                this.$router.push('/suppliers');
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>

<style scoped>
.form-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

form {
    display: flex;
    flex-direction: column;
}

input {
    margin-bottom: 10px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.product-item {
    margin-bottom: 20px;
    padding: 10px;
    background-color: #e9ecef;
    border-radius: 4px;
}

button {
    padding: 10px;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    padding-bottom: 3px;
}

button:hover {
    background-color: #0056b3;
}

button[type="button"] {
    background-color: #28a745;
    margin-right: 10px;
    padding-bottom: 3px;
}

button[type="button"]:hover {
    background-color: #218838;
}
</style>
