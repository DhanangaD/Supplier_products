<template>
    <div class="container">
      <input
        v-model="search"
        @input="searchSuppliers"
        placeholder="Search by Name or Mobile"
        class="search-input"
      />
      <div v-for="(supplier, index) in paginatedSuppliers" :key="index" class="supplier-card">
        <h3>{{ supplier.name }}</h3>
        <p>{{ supplier.contact_person }} - {{ supplier.mobile_numbers }}</p>
      </div>
      <div class="pagination">
        <button @click="prevPage" :disabled="currentPage === 1">Previous</button>
        <span>{{ currentPage }}</span>
        <button @click="nextPage" :disabled="currentPage === totalPages">Next</button>
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
        currentPage: 1,
        pageSize: 20, // Number of items per page
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
          this.suppliers = response.data; // Assuming your API response structure includes all suppliers
          this.currentPage = 1; // Reset current page when searching
        } catch (error) {
          console.error("Error fetching suppliers:", error);
        }
      },
      nextPage() {
        if (this.currentPage < this.totalPages) {
          this.currentPage++;
        }
      },
      prevPage() {
        if (this.currentPage > 1) {
          this.currentPage--;
        }
      },
    },
    computed: {
      totalPages() {
        return Math.ceil(this.suppliers.length / this.pageSize);
      },
      paginatedSuppliers() {
        const startIndex = (this.currentPage - 1) * this.pageSize;
        return this.suppliers.slice(startIndex, startIndex + this.pageSize);
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