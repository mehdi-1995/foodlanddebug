<!-- resources/js/components/VendorDashboard.vue -->
<template>
  <div>
    <!-- بقیه داشبورد -->
    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
      <h3 class="text-lg font-bold">آپلود منو</h3>
      <input type="file" @change="uploadMenu" accept=".xlsx,.xls" />
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  methods: {
    async uploadMenu(event) {
      const formData = new FormData();
      formData.append('file', event.target.files[0]);
      try {
        await axios.post('/api/menu/upload', formData, {
          headers: { 'Content-Type': 'multipart/form-data' },
        });
        alert('منو با موفقیت آپلود شد!');
      } catch (error) {
        alert('خطا در آپلود: ' + error.response.data.message);
      }
    },
  },
};
</script>
