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
        <button @click="editSupplier(supplier)">Edit</button>
        <button @click="deleteSupplier(supplier)">Delete</button>
      </div>
      <div class="pagination">
        <button @click="prevPage" :disabled="currentPage === 1">Previous</button>
        <span>{{ currentPage }}</span>
        <button @click="nextPage" :disabled="currentPage === totalPages">Next</button>
      </div>
  
      <!-- Modal for adding/updating supplier -->
      <div class="modal" :class="{ 'is-active': isModalActive }">
        <div class="modal-background" @click="closeModal"></div>
        <div class="modal-content">
          <div class="box">
            <h2>{{ modalTitle }}</h2>
            <form @submit.prevent="saveSupplier">
              <div class="field">
                <label class="label">Name</label>
                <div class="control">
                  <input v-model="formData.name" class="input" type="text" required>
                </div>
              </div>
              <div class="field">
                <label class="label">Contact Person</label>
                <div class="control">
                  <input v-model="formData.contact_person" class="input" type="text" required>
                </div>
              </div>
              <div class="field">
                <label class="label">Mobile Numbers</label>
                <div class="control">
                  <input v-model="formData.mobile_numbers" class="input" type="text" required>
                </div>
              </div>
              <!-- Add more fields here as needed -->
              <div class="field is-grouped">
                <div class="control">
                  <button type="submit" class="button is-primary">{{ submitButtonText }}</button>
                </div>
                <div class="control">
                  <button @click="closeModal" class="button is-link">Cancel</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <button class="modal-close is-large" aria-label="close" @click="closeModal"></button>
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
        formData: {
          id: null,
          name: "",
          contact_person: "",
          mobile_numbers: "",
          // Add more fields as needed
        },
        isModalActive: false,
        submitButtonText: "Add Supplier",
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
      editSupplier(supplier) {
        this.formData.id = supplier.id;
        this.formData.name = supplier.name;
        this.formData.contact_person = supplier.contact_person;
        this.formData.mobile_numbers = supplier.mobile_numbers;
        // Assign more fields as needed
  
        this.submitButtonText = "Update Supplier";
        this.isModalActive = true;
      },
      async saveSupplier() {
        try {
          if (this.formData.id) {
            // Update existing supplier
            await axios.put(`/api/suppliers/${this.formData.id}`, this.formData);
          } else {
            // Add new supplier
            await axios.post(`/api/suppliers`, this.formData);
          }
          this.closeModal();
          this.searchSuppliers(); // Refresh supplier list after save
        } catch (error) {
          console.error("Error saving supplier:", error);
        }
      },
      async deleteSupplier(supplier) {
        try {
          if (confirm(`Are you sure you want to delete ${supplier.name}?`)) {
            await axios.delete(`/api/suppliers/${supplier.id}`);
            this.searchSuppliers(); // Refresh supplier list after delete
          }
        } catch (error) {
          console.error("Error deleting supplier:", error);
        }
      },
      closeModal() {
        this.formData.id = null;
        this.formData.name = "";
        this.formData.contact_person = "";
        this.formData.mobile_numbers = "";
        // Clear more fields as needed
  
        this.submitButtonText = "Add Supplier";
        this.isModalActive = false;
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
  
  .modal {
    display: none;
  }
  
  .modal.is-active {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
  }
  
  .modal-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    background-color: transparent;
  }
  
  .modal-content {
    position: relative;
    width: 60%;
    max-width: 600px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }
  
  .modal-close {
    position: absolute;
    top: 15px;
    right: 15px;
    cursor: pointer;
    background-color: transparent;
    border: none;
    z-index: 1001;
    color: #000;
  }
  
  .modal-close:hover {
    color: #333;
  }
  </style>  