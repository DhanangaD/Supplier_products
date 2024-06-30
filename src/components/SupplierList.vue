<template>
    <div class="container">
      <input
        v-model="search"
        @input="searchSuppliers"
        placeholder="Search by Name or Mobile"
        class="search-input"
      />
      <div v-for="supplier in suppliers" :key="supplier.id" class="supplier-card">
        <h3>{{ supplier.name }}</h3>
        <p>{{ supplier.contact_person }} - {{ supplier.mobile_numbers }}</p>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    data() {
      return {
        suppliers: [],
        search: "",
      };
    },
    created() {
      this.searchSuppliers();
    },
    methods: {
      async searchSuppliers() {
        try {
          const response = await axios.get('/api/suppliers', {
            params: { search: this.search },
          });
          this.suppliers = response.data.data; // Adjust according to your API response structure
        } catch (error) {
          console.error("Error fetching suppliers:", error);
        }
      },
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
  </style>
  