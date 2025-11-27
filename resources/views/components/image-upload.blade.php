@props(['name' => 'foto', 'value' => null, 'required' => false])

<div class="image-upload-container">
    <label class="block text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
        <i class="fas fa-image text-primary-600"></i>
        <span>Upload Gambar @if($required)<span class="text-red-500">*</span>@endif</span>
    </label>
    
    <div class="border-3 border-dashed border-gray-300 rounded-2xl p-6 text-center hover:border-primary-400 transition-all duration-300 bg-gray-50/50 cursor-pointer group relative"
         id="upload-container-{{ $name }}">
        
        <!-- Progress Bar -->
        <div id="progress-bar-{{ $name }}" class="hidden absolute top-0 left-0 w-full h-2 bg-gray-200 rounded-t-2xl overflow-hidden">
            <div class="progress-fill h-full bg-gradient-to-r from-primary-500 to-primary-600 transition-all duration-300" style="width: 0%"></div>
        </div>
        
        <!-- Image Preview -->
        <div id="image-preview-{{ $name }}" class="hidden mb-4">
            <div class="relative inline-block group">
                <img id="preview-{{ $name }}" class="w-40 h-32 object-cover rounded-2xl border-2 border-primary-300 shadow-lg">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 rounded-2xl flex items-center justify-center">
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex space-x-2">
                        <button type="button" 
                                class="bg-white text-gray-700 rounded-full w-8 h-8 flex items-center justify-center text-sm hover:bg-gray-100 transition-colors shadow-lg"
                                onclick="previewImage('{{ $name }}')"
                                title="Preview">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" 
                                class="bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm hover:bg-red-600 transition-colors shadow-lg"
                                onclick="removeImage('{{ $name }}')"
                                title="Hapus">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="absolute -bottom-2 -right-2 bg-white rounded-full px-2 py-1 text-xs text-gray-600 shadow-lg border">
                    <span id="file-size-{{ $name }}"></span>
                </div>
            </div>
            <p class="text-sm text-gray-500 mt-2">Klik gambar untuk opsi lainnya</p>
        </div>
        
        <!-- Upload Area -->
        <div id="upload-area-{{ $name }}" class="group-hover:scale-105 transition-transform duration-300">
            <div class="w-16 h-16 bg-gradient-to-br from-primary-100 to-primary-200 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:from-primary-200 group-hover:to-primary-300 transition-colors">
                <i class="fas fa-cloud-upload-alt text-2xl text-primary-600"></i>
            </div>
            <p class="text-lg font-semibold text-gray-700 mb-2">Upload Gambar</p>
            <p class="text-sm text-gray-500 mb-2">Drag & drop atau klik untuk upload</p>
            <p class="text-xs text-gray-400">PNG, JPG, JPEG, GIF (Max. 5MB)</p>
        </div>
        
        <input type="file" 
               name="{{ $name }}" 
               id="{{ $name }}" 
               class="hidden" 
               accept="image/*"
               @if($required) required @endif>
    </div>
    
    @error($name)
        <p class="text-red-500 text-sm mt-3 flex items-center space-x-2">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $message }}</span>
        </p>
    @enderror
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('upload-container-{{ $name }}');
    const fileInput = document.getElementById('{{ $name }}');
    const preview = document.getElementById('preview-{{ $name }}');
    const imagePreview = document.getElementById('image-preview-{{ $name }}');
    const uploadArea = document.getElementById('upload-area-{{ $name }}');
    
    container.addEventListener('click', () => fileInput.click());
    
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 5 * 1024 * 1024) {
                showNotification('Ukuran file terlalu besar. Maksimal 5MB.', 'error');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                imagePreview.classList.remove('hidden');
                uploadArea.classList.add('hidden');
                
                const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                document.getElementById('file-size-{{ $name }}').textContent = `${sizeInMB}MB`;
                
                showNotification('Gambar berhasil diupload!', 'success');
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Drag & Drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        container.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
        container.addEventListener(eventName, () => {
            container.classList.add('border-primary-400', 'bg-primary-50');
        }, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        container.addEventListener(eventName, () => {
            container.classList.remove('border-primary-400', 'bg-primary-50');
        }, false);
    });
    
    container.addEventListener('drop', function(e) {
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            fileInput.dispatchEvent(new Event('change'));
        }
    }, false);
});

function removeImage(fieldName) {
    document.getElementById(fieldName).value = '';
    document.getElementById(`image-preview-${fieldName}`).classList.add('hidden');
    document.getElementById(`upload-area-${fieldName}`).classList.remove('hidden');
    showNotification('Gambar berhasil dihapus', 'success');
}

function previewImage(fieldName) {
    const preview = document.getElementById(`preview-${fieldName}`);
    window.open(preview.src, '_blank');
}
</script>