@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">✍️ Buat Artikel Baru</h1>
            <p class="text-gray-600">Bagikan cerita, informasi, dan inspirasi Anda dengan komunitas sekolah</p>
        </div>

        <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Title Section -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-heading text-blue-600"></i>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-800">Judul Artikel</h2>
                        </div>
                        <input type="text" 
                               name="judul" 
                               id="judul"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-lg font-medium"
                               placeholder="Masukkan judul artikel yang menarik..."
                               required>
                        <div class="mt-2 flex items-center justify-between text-sm">
                            <span class="text-gray-500">Karakter: <span id="titleCount">0</span>/100</span>
                            <span class="text-gray-400">💡 Tip: Gunakan judul yang menarik dan deskriptif</span>
                        </div>
                    </div>

                    <!-- Content Editor -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-edit text-green-600"></i>
                                </div>
                                <h2 class="text-xl font-semibold text-gray-800">Isi Artikel</h2>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button type="button" class="text-gray-500 hover:text-gray-700 p-2" title="Bold" onclick="formatText('bold')">
                                    <i class="fas fa-bold"></i>
                                </button>
                                <button type="button" class="text-gray-500 hover:text-gray-700 p-2" title="Italic" onclick="formatText('italic')">
                                    <i class="fas fa-italic"></i>
                                </button>
                                <button type="button" class="text-gray-500 hover:text-gray-700 p-2" title="List" onclick="insertList()">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                        </div>
                        <textarea name="isi" 
                                  id="isi"
                                  rows="12"
                                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all resize-none"
                                  placeholder="Tulis artikel Anda di sini... 

📝 Tips menulis artikel yang baik:
• Gunakan paragraf yang jelas dan terstruktur
• Sertakan informasi yang akurat dan bermanfaat  
• Gunakan bahasa yang mudah dipahami
• Tambahkan contoh atau ilustrasi jika perlu"
                                  required></textarea>
                        <div class="mt-2 flex items-center justify-between text-sm">
                            <span class="text-gray-500">Kata: <span id="wordCount">0</span> | Karakter: <span id="charCount">0</span></span>
                            <span class="text-gray-400">📖 Minimal 50 kata untuk artikel berkualitas</span>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-image text-purple-600"></i>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-800">Gambar Artikel</h2>
                            <span class="text-sm text-gray-500">(Opsional)</span>
                        </div>
                        
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-purple-400 transition-colors" id="dropZone">
                            <div id="uploadArea">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                <p class="text-lg font-medium text-gray-600 mb-2">Drag & Drop gambar di sini</p>
                                <p class="text-gray-500 mb-4">atau</p>
                                <label for="foto" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg cursor-pointer transition-colors inline-flex items-center space-x-2">
                                    <i class="fas fa-plus"></i>
                                    <span>Pilih Gambar</span>
                                </label>
                                <input type="file" name="foto" id="foto" class="hidden" accept="image/*">
                                <p class="text-xs text-gray-400 mt-3">JPG, PNG, GIF (Max: 5MB)</p>
                            </div>
                            <div id="imagePreview" class="hidden">
                                <img id="previewImg" class="max-w-full h-64 object-cover rounded-lg mx-auto mb-4">
                                <div class="flex items-center justify-center space-x-4">
                                    <button type="button" onclick="removeImage()" class="text-red-600 hover:text-red-700 flex items-center space-x-1">
                                        <i class="fas fa-trash"></i>
                                        <span>Hapus</span>
                                    </button>
                                    <label for="foto" class="text-purple-600 hover:text-purple-700 cursor-pointer flex items-center space-x-1">
                                        <i class="fas fa-sync"></i>
                                        <span>Ganti</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-tags text-yellow-600"></i>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-800">Tags</h2>
                            <span class="text-sm text-gray-500">(Opsional)</span>
                        </div>
                        <input type="text" 
                               name="tags" 
                               id="tags"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all"
                               placeholder="Masukkan tags dipisah koma (contoh: sekolah, prestasi, olahraga)">
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">🏷️ Tags membantu pembaca menemukan artikel Anda</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Publish Options -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                            <i class="fas fa-cog text-gray-600"></i>
                            <span>Pengaturan Publikasi</span>
                        </h3>
                        
                        <!-- Category -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select name="id_kategori" 
                                    class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <div class="space-y-2">
                                @if(auth()->user()->isSiswa())
                                <div class="flex items-center p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                    <i class="fas fa-clock text-yellow-600 mr-2"></i>
                                    <span class="text-sm text-yellow-800">Artikel akan dikirim untuk review</span>
                                </div>
                                @else
                                <div class="grid grid-cols-2 gap-2">
                                    <label class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="status" value="draft" class="mr-2" checked>
                                        <span class="text-sm">Draft</span>
                                    </label>
                                    <label class="flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="status" value="published" class="mr-2">
                                        <span class="text-sm">Publish</span>
                                    </label>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Schedule -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-calendar mr-1"></i>
                                Jadwal Publikasi
                            </label>
                            <input type="datetime-local" 
                                   name="scheduled_at"
                                   class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Kosongkan untuk publikasi langsung</p>
                        </div>
                    </div>

                    <!-- Preview -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                            <i class="fas fa-eye text-gray-600"></i>
                            <span>Preview</span>
                        </h3>
                        <div id="articlePreview" class="border border-gray-200 rounded-lg p-4 bg-gray-50 min-h-32">
                            <p class="text-gray-500 text-center">Preview akan muncul saat Anda mengetik...</p>
                        </div>
                        <button type="button" 
                                onclick="updatePreview()"
                                class="w-full mt-3 bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 rounded-lg transition-colors">
                            <i class="fas fa-sync mr-1"></i>
                            Refresh Preview
                        </button>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        <div class="space-y-3">
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-3 px-4 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg flex items-center justify-center space-x-2">
                                <i class="fas fa-paper-plane"></i>
                                <span>Publikasikan Artikel</span>
                            </button>
                            
                            <button type="button" 
                                    onclick="saveDraft()"
                                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-4 rounded-xl font-medium transition-colors flex items-center justify-center space-x-2">
                                <i class="fas fa-save"></i>
                                <span>Simpan Draft</span>
                            </button>
                            
                            <a href="{{ route('dashboard') }}" 
                               class="w-full bg-white border-2 border-gray-300 hover:border-gray-400 text-gray-700 py-3 px-4 rounded-xl font-medium transition-colors flex items-center justify-center space-x-2">
                                <i class="fas fa-arrow-left"></i>
                                <span>Kembali</span>
                            </a>
                        </div>
                    </div>

                    <!-- Tips -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 border border-blue-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center space-x-2">
                            <i class="fas fa-lightbulb text-yellow-500"></i>
                            <span>Tips Menulis</span>
                        </h3>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-start space-x-2">
                                <i class="fas fa-check text-green-500 mt-0.5"></i>
                                <span>Gunakan judul yang menarik dan informatif</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <i class="fas fa-check text-green-500 mt-0.5"></i>
                                <span>Buat paragraf pembuka yang engaging</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <i class="fas fa-check text-green-500 mt-0.5"></i>
                                <span>Sertakan gambar yang relevan</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <i class="fas fa-check text-green-500 mt-0.5"></i>
                                <span>Periksa ejaan dan tata bahasa</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Character counting
document.getElementById('judul').addEventListener('input', function() {
    document.getElementById('titleCount').textContent = this.value.length;
});

document.getElementById('isi').addEventListener('input', function() {
    const text = this.value;
    const words = text.trim() ? text.trim().split(/\s+/).length : 0;
    document.getElementById('wordCount').textContent = words;
    document.getElementById('charCount').textContent = text.length;
    updatePreview();
});

// Image upload
const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('foto');
const uploadArea = document.getElementById('uploadArea');
const imagePreview = document.getElementById('imagePreview');
const previewImg = document.getElementById('previewImg');

// Drag and drop
dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('border-purple-400', 'bg-purple-50');
});

dropZone.addEventListener('dragleave', () => {
    dropZone.classList.remove('border-purple-400', 'bg-purple-50');
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('border-purple-400', 'bg-purple-50');
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        handleImageUpload(files[0]);
    }
});

fileInput.addEventListener('change', function() {
    if (this.files && this.files[0]) {
        handleImageUpload(this.files[0]);
    }
});

function handleImageUpload(file) {
    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            uploadArea.classList.add('hidden');
            imagePreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    fileInput.value = '';
    uploadArea.classList.remove('hidden');
    imagePreview.classList.add('hidden');
}

// Text formatting
function formatText(command) {
    const textarea = document.getElementById('isi');
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const selectedText = textarea.value.substring(start, end);
    
    let formattedText = selectedText;
    if (command === 'bold') {
        formattedText = `**${selectedText}**`;
    } else if (command === 'italic') {
        formattedText = `*${selectedText}*`;
    }
    
    textarea.value = textarea.value.substring(0, start) + formattedText + textarea.value.substring(end);
    textarea.focus();
}

function insertList() {
    const textarea = document.getElementById('isi');
    const cursorPos = textarea.selectionStart;
    const textBefore = textarea.value.substring(0, cursorPos);
    const textAfter = textarea.value.substring(cursorPos);
    
    const listText = '\n• Item 1\n• Item 2\n• Item 3\n';
    textarea.value = textBefore + listText + textAfter;
    textarea.focus();
}

// Preview
function updatePreview() {
    const title = document.getElementById('judul').value;
    const content = document.getElementById('isi').value;
    const preview = document.getElementById('articlePreview');
    
    if (title || content) {
        preview.innerHTML = `
            <div class="space-y-3">
                ${title ? `<h3 class="font-bold text-lg text-gray-800">${title}</h3>` : ''}
                ${content ? `<p class="text-gray-600 text-sm leading-relaxed">${content.substring(0, 200)}${content.length > 200 ? '...' : ''}</p>` : ''}
            </div>
        `;
    } else {
        preview.innerHTML = '<p class="text-gray-500 text-center">Preview akan muncul saat Anda mengetik...</p>';
    }
}

// Save draft
function saveDraft() {
    const form = document.getElementById('articleForm');
    const statusInputs = document.querySelectorAll('input[name="status"]');
    statusInputs.forEach(input => {
        if (input.value === 'draft') {
            input.checked = true;
        }
    });
    form.submit();
}

// Form validation
document.getElementById('articleForm').addEventListener('submit', function(e) {
    const title = document.getElementById('judul').value.trim();
    const content = document.getElementById('isi').value.trim();
    
    if (title.length < 5) {
        e.preventDefault();
        alert('Judul artikel minimal 5 karakter');
        return;
    }
    
    if (content.length < 50) {
        e.preventDefault();
        alert('Isi artikel minimal 50 karakter');
        return;
    }
});
</script>
@endsection