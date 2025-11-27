@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-white mb-3">Buat Artikel Baru</h1>
                <p class="text-xl text-gray-300">Bagikan cerita, informasi, atau karya terbarumu dengan komunitas sekolah</p>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-sm text-gray-400">Auto-save aktif</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-3">
            <div class="bg-gray-800 rounded-3xl shadow-2xl p-8 border border-gray-700">
                <!-- Progress Steps -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center justify-center w-8 h-8 bg-primary-600 text-white rounded-full font-semibold">
                                1
                            </div>
                            <span class="font-semibold text-white">Informasi Dasar</span>
                        </div>
                        <div class="h-1 w-8 bg-gray-300"></div>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center justify-center w-8 h-8 bg-gray-300 text-gray-600 rounded-full font-semibold">
                                2
                            </div>
                            <span class="font-semibold text-gray-400">Konten Artikel</span>
                        </div>
                        <div class="h-1 w-8 bg-gray-300"></div>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center justify-center w-8 h-8 bg-gray-300 text-gray-600 rounded-full font-semibold">
                                3
                            </div>
                            <span class="font-semibold text-gray-400">Preview</span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
                    @csrf
                    
                    <!-- Judul -->
                    <div class="mb-8">
                        <label for="judul" class="block text-lg font-semibold text-white mb-4 flex items-center space-x-2">
                            <i class="fas fa-heading text-primary-600"></i>
                            <span>Judul Artikel <span class="text-red-500">*</span></span>
                        </label>
                        <input type="text" 
                               name="judul" 
                               id="judul"
                               value="{{ old('judul') }}"
                               class="w-full px-6 py-5 text-xl border-2 border-gray-600 rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-300 hover:border-gray-500 bg-gray-700 text-white"
                               placeholder="Tulis judul artikel yang menarik dan informatif..."
                               required
                               maxlength="255">
                        <div class="flex justify-between items-center mt-3">
                            <div class="text-sm text-gray-400 flex items-center space-x-2">
                                <i class="fas fa-lightbulb text-yellow-500"></i>
                                <span>Gunakan judul yang menarik perhatian pembaca</span>
                            </div>
                            <div class="text-sm text-gray-400">
                                <span id="judul-count">0</span>/255 karakter
                            </div>
                        </div>
                        @error('judul')
                            <p class="text-red-500 text-sm mt-3 flex items-center space-x-2">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Kategori & Cover Image -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <!-- Kategori -->
                        <div>
                            <label for="id_kategori" class="block text-lg font-semibold text-white mb-4 flex items-center space-x-2">
                                <i class="fas fa-tag text-primary-600"></i>
                                <span>Kategori <span class="text-red-500">*</span></span>
                            </label>
                            <div class="relative">
                                <select name="id_kategori" 
                                        id="id_kategori"
                                        class="w-full px-6 py-5 border-2 border-gray-600 rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-300 hover:border-gray-500 bg-gray-700 text-white appearance-none"
                                        required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                            @error('id_kategori')
                                <p class="text-red-500 text-sm mt-3 flex items-center space-x-2">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        <!-- Cover Image -->
                        <div>
                            <label class="block text-lg font-semibold text-white mb-4 flex items-center space-x-2">
                                <i class="fas fa-image text-primary-600"></i>
                                <span>Cover Image</span>
                            </label>
                            <div id="upload-container" class="relative border-2 border-dashed border-gray-600 rounded-xl p-6 text-center cursor-pointer hover:border-primary-500 transition-all duration-300 bg-gray-700">
                                <input type="file" 
                                       name="foto" 
                                       id="foto" 
                                       class="hidden" 
                                       accept="image/jpeg,image/jpg,image/png,image/gif,image/webp">
                                <div id="upload-area">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                    <p class="text-white font-medium mb-2">Klik untuk pilih gambar dari folder</p>
                                    <p class="text-xs text-gray-400 mb-2">atau drag & drop gambar ke sini</p>
                                    <p class="text-xs text-gray-500">Format: JPG, PNG, GIF, WEBP (Max: 5MB)</p>
                                </div>
                                <div id="image-preview" class="hidden">
                                    <img id="preview" class="max-w-full h-32 object-cover rounded-lg mx-auto mb-3">
                                    <button type="button" onclick="removeImage()" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </div>
                            </div>
                            @error('foto')
                                <p class="text-red-500 text-sm mt-3 flex items-center space-x-2">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Konten -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <label for="isi" class="block text-lg font-semibold text-white flex items-center space-x-2">
                                <i class="fas fa-edit text-primary-600"></i>
                                <span>Konten Artikel <span class="text-red-500">*</span></span>
                            </label>
                            <div class="flex items-center space-x-4 text-sm text-gray-400">
                                <span id="char-count">0 karakter</span>
                                <span id="word-count">0 kata</span>
                                <span id="read-time">0 menit baca</span>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <textarea name="isi" 
                                      id="isi" 
                                      rows="18"
                                      class="w-full px-6 py-6 border-2 border-gray-600 rounded-2xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-300 hover:border-gray-500 resize-none bg-gray-700 text-white leading-relaxed"
                                      placeholder="Tulis isi artikelmu di sini...&#10;&#10;• Gunakan paragraf yang jelas&#10;• Sertakan informasi yang relevan&#10;• Jelaskan dengan bahasa yang mudah dipahami"
                                      required>{{ old('isi') }}</textarea>
                            
                            <!-- Writing Tools -->
                            <div class="absolute bottom-4 right-4 flex items-center space-x-2">
                                <button type="button" 
                                        class="w-8 h-8 bg-gray-600 hover:bg-gray-500 text-gray-300 rounded-lg flex items-center justify-center transition-colors"
                                        onclick="formatText('bold')"
                                        title="Bold">
                                    <i class="fas fa-bold text-sm"></i>
                                </button>
                                <button type="button" 
                                        class="w-8 h-8 bg-gray-600 hover:bg-gray-500 text-gray-300 rounded-lg flex items-center justify-center transition-colors"
                                        onclick="formatText('italic')"
                                        title="Italic">
                                    <i class="fas fa-italic text-sm"></i>
                                </button>
                                <button type="button" 
                                        class="w-8 h-8 bg-gray-600 hover:bg-gray-500 text-gray-300 rounded-lg flex items-center justify-center transition-colors"
                                        onclick="insertBullet()"
                                        title="Bullet Point">
                                    <i class="fas fa-list-ul text-sm"></i>
                                </button>
                            </div>
                        </div>
                        
                        @error('isi')
                            <p class="text-red-500 text-sm mt-3 flex items-center space-x-2">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-600">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold py-5 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-3 group">
                            <i class="fas fa-save text-lg group-hover:rotate-12 transition-transform"></i>
                            <span class="text-lg">Simpan sebagai Draft</span>
                        </button>
                        <button type="button" 
                                onclick="previewArticle()"
                                class="flex-1 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold py-5 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-3 group">
                            <i class="fas fa-eye text-lg group-hover:scale-110 transition-transform"></i>
                            <span class="text-lg">Pratinjau</span>
                        </button>
                        <a href="{{ route('artikel.index') }}" 
                           class="flex-1 bg-gray-700 border-2 border-gray-600 text-gray-300 hover:border-gray-500 hover:bg-gray-600 font-semibold py-5 px-8 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-3 group">
                            <i class="fas fa-arrow-left text-lg group-hover:-translate-x-1 transition-transform"></i>
                            <span class="text-lg">Kembali</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Writing Assistant -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl p-6 text-white shadow-xl">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h3 class="font-bold text-lg">Asisten Menulis</h3>
                </div>
                <div class="space-y-4 text-sm">
                    <div class="bg-white/10 rounded-xl p-3">
                        <p class="font-semibold mb-2">📊 Statistik Konten</p>
                        <div class="space-y-2 text-blue-100">
                            <div class="flex justify-between">
                                <span>Karakter</span>
                                <span class="font-semibold" id="sidebar-char-count">0</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Kata</span>
                                <span class="font-semibold" id="sidebar-word-count">0</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Paragraf</span>
                                <span class="font-semibold" id="sidebar-para-count">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white/10 rounded-xl p-3">
                        <p class="font-semibold mb-2">🎯 Target Pembaca</p>
                        <p class="text-blue-100">Siswa, Guru, & Staff Sekolah</p>
                    </div>
                </div>
            </div>

            <!-- Writing Tips -->
            <div class="bg-gray-800 rounded-3xl shadow-xl p-6 border border-gray-700">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-lightbulb text-green-600"></i>
                    </div>
                    <h3 class="font-bold text-white">Tips Menulis</h3>
                </div>
                <ul class="space-y-3 text-sm text-gray-300">
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check text-green-500 mt-0.5"></i>
                        <span>Gunakan bahasa yang mudah dipahami</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check text-green-500 mt-0.5"></i>
                        <span>Pembuka yang menarik perhatian</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check text-green-500 mt-0.5"></i>
                        <span>Gunakan paragraf pendek</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check text-green-500 mt-0.5"></i>
                        <span>Sertakan gambar pendukung</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <i class="fas fa-check text-green-500 mt-0.5"></i>
                        <span>Periksa ejaan dan tata bahasa</span>
                    </li>
                </ul>
            </div>

            <!-- Quick Actions -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-3xl p-6 text-white shadow-xl">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="font-bold text-lg">Aksi Cepat</h3>
                </div>
                <div class="space-y-3">
                    <button onclick="insertTemplate('news')" 
                            class="w-full bg-white/10 hover:bg-white/20 text-white font-medium py-3 px-4 rounded-xl transition-all duration-300 flex items-center justify-center space-x-2">
                        <i class="fas fa-newspaper"></i>
                        <span>Template Berita</span>
                    </button>
                    <button onclick="insertTemplate('event')" 
                            class="w-full bg-white/10 hover:bg-white/20 text-white font-medium py-3 px-4 rounded-xl transition-all duration-300 flex items-center justify-center space-x-2">
                        <i class="fas fa-calendar"></i>
                        <span>Template Acara</span>
                    </button>
                    <button onclick="clearContent()" 
                            class="w-full bg-white/10 hover:bg-white/20 text-white font-medium py-3 px-4 rounded-xl transition-all duration-300 flex items-center justify-center space-x-2">
                        <i class="fas fa-eraser"></i>
                        <span>Bersihkan</span>
                    </button>
                </div>
            </div>

            <!-- Status Info -->
            <div class="bg-gray-800 rounded-3xl shadow-xl p-6 border border-gray-700">
                <h3 class="font-bold text-white mb-4">Status Artikel</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center justify-between p-3 bg-orange-50 rounded-xl border border-orange-200">
                        <span class="text-orange-700 font-semibold">Status</span>
                        <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-semibold">Draft</span>
                    </div>
                    <div class="text-gray-300">
                        <p class="flex items-center space-x-2 mb-2">
                            <i class="fas fa-info-circle text-blue-500"></i>
                            <span>Artikel akan disimpan sebagai draft</span>
                        </p>
                        <p class="flex items-center space-x-2">
                            <i class="fas fa-clock text-purple-500"></i>
                            <span>Guru/Admin akan memverifikasi</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-gray-800 rounded-3xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-600">
            <h3 class="text-2xl font-bold text-white">Pratinjau Artikel</h3>
            <button onclick="closePreview()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
            <div id="previewContent" class="prose max-w-none">
                <!-- Preview content will be inserted here -->
            </div>
        </div>
        <div class="flex justify-end space-x-3 p-6 border-t border-gray-600">
            <button onclick="closePreview()" 
                    class="bg-gray-600 hover:bg-gray-500 text-white font-semibold py-3 px-6 rounded-xl transition-colors">
                Tutup
            </button>
            <button type="submit" form="articleForm"
                    class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 px-6 rounded-xl transition-colors">
                Simpan Artikel
            </button>
        </div>
    </div>
</div>

<script>
    // Character and Word Count
    const judulInput = document.getElementById('judul');
    const judulCount = document.getElementById('judul-count');
    const textarea = document.getElementById('isi');
    const charCount = document.getElementById('char-count');
    const wordCount = document.getElementById('word-count');
    const readTime = document.getElementById('read-time');
    const sidebarCharCount = document.getElementById('sidebar-char-count');
    const sidebarWordCount = document.getElementById('sidebar-word-count');
    const sidebarParaCount = document.getElementById('sidebar-para-count');

    function updateCounts() {
        const judulText = judulInput.value;
        const text = textarea.value;
        const characters = text.length;
        const words = text.trim() ? text.trim().split(/\s+/).length : 0;
        const paragraphs = text.trim() ? text.trim().split(/\n+/).length : 0;
        const readingTime = Math.ceil(words / 200); // Average reading speed

        judulCount.textContent = judulText.length;
        charCount.textContent = `${characters} karakter`;
        wordCount.textContent = `${words} kata`;
        readTime.textContent = `${readingTime} menit baca`;
        
        sidebarCharCount.textContent = characters;
        sidebarWordCount.textContent = words;
        sidebarParaCount.textContent = paragraphs;
    }

    judulInput.addEventListener('input', updateCounts);
    textarea.addEventListener('input', updateCounts);
    updateCounts();

    // Image Upload Functionality
    const uploadContainer = document.getElementById('upload-container');
    const uploadArea = document.getElementById('upload-area');
    const imagePreview = document.getElementById('image-preview');
    const fileInput = document.getElementById('foto');
    const previewImage = document.getElementById('preview');

    uploadContainer.addEventListener('click', function() {
        fileInput.click();
    });

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 5 * 1024 * 1024) {
                showNotification('Ukuran file terlalu besar. Maksimal 5MB.', 'error');
                fileInput.value = '';
                return;
            }

            const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            if (!validTypes.includes(file.type)) {
                showNotification('Format file tidak didukung. Gunakan JPG, PNG, GIF, atau WEBP.', 'error');
                fileInput.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                imagePreview.classList.remove('hidden');
                uploadArea.classList.add('hidden');
                showNotification('Gambar berhasil diupload!', 'success');
            }
            reader.readAsDataURL(file);
        }
    });

    function removeImage() {
        fileInput.value = '';
        imagePreview.classList.add('hidden');
        uploadArea.classList.remove('hidden');
    }

    // Drag and Drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadContainer.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadContainer.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadContainer.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        uploadContainer.classList.add('border-primary-400', 'bg-primary-50');
    }

    function unhighlight() {
        uploadContainer.classList.remove('border-primary-400', 'bg-primary-50');
    }

    uploadContainer.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            const file = files[0];
            if (file.type.startsWith('image/')) {
                fileInput.files = files;
                fileInput.dispatchEvent(new Event('change'));
            } else {
                showNotification('File harus berupa gambar!', 'error');
            }
        }
    }

    // Paste image from clipboard
    document.addEventListener('paste', function(e) {
        const items = e.clipboardData.items;
        for (let i = 0; i < items.length; i++) {
            if (items[i].type.indexOf('image') !== -1) {
                const blob = items[i].getAsFile();
                const file = new File([blob], 'pasted-image.png', { type: blob.type });
                
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;
                fileInput.dispatchEvent(new Event('change'));
                
                showNotification('Gambar dari clipboard berhasil ditempelkan!', 'success');
                e.preventDefault();
                break;
            }
        }
    });

    // Text Formatting Tools
    function formatText(type) {
        const textarea = document.getElementById('isi');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const selectedText = textarea.value.substring(start, end);
        
        let formattedText = '';
        switch(type) {
            case 'bold':
                formattedText = `**${selectedText}**`;
                break;
            case 'italic':
                formattedText = `_${selectedText}_`;
                break;
        }
        
        textarea.value = textarea.value.substring(0, start) + formattedText + textarea.value.substring(end);
        textarea.focus();
        textarea.setSelectionRange(start + formattedText.length, start + formattedText.length);
    }

    function insertBullet() {
        const textarea = document.getElementById('isi');
        const start = textarea.selectionStart;
        textarea.value = textarea.value.substring(0, start) + '\n• ' + textarea.value.substring(start);
        textarea.focus();
        textarea.setSelectionRange(start + 3, start + 3);
    }

    // Template Functions
    function insertTemplate(type) {
        const textarea = document.getElementById('isi');
        let template = '';
        
        switch(type) {
            case 'news':
                template = `Halo semuanya!

Kami dengan senang hati ingin membagikan berita terbaru dari sekolah kita.

• [Point penting pertama]
• [Point penting kedua] 
• [Point penting ketiga]

Mari kita bersama-sama mendukung dan mengapresiasi pencapaian ini!

Salam,
[Penulis]`;
                break;
            case 'event':
                template = `📢 PENGUMUMAN PENTING

Kepada seluruh warga sekolah,

Kami mengundang Bapak/Ibu dan Siswa/Siswi untuk menghadiri:

🎉 [Nama Acara]
📅 [Tanggal]
⏰ [Waktu]
📍 [Lokasi]

Acara ini akan menampilkan:
• [Aktivitas 1]
• [Aktivitas 2]
• [Aktivitas 3]

Jangan lewatkan kesempatan ini!`;
                break;
        }
        
        textarea.value = template;
        updateCounts();
        showNotification('Template berhasil dimasukkan!', 'success');
    }

    function clearContent() {
        if (confirm('Apakah Anda yakin ingin menghapus semua konten?')) {
            document.getElementById('isi').value = '';
            updateCounts();
            showNotification('Konten berhasil dibersihkan!', 'success');
        }
    }

    // Preview Functionality
    function previewArticle() {
        const judul = document.getElementById('judul').value;
        const isi = document.getElementById('isi').value;
        const previewImg = document.getElementById('preview');
        
        if (!judul || !isi) {
            showNotification('Judul dan konten harus diisi terlebih dahulu!', 'error');
            return;
        }
        
        const previewContent = document.getElementById('previewContent');
        let imageHtml = '';
        if (previewImg.src && !imagePreview.classList.contains('hidden')) {
            imageHtml = `<img src="${previewImg.src}" class="w-full h-64 object-cover rounded-xl mb-6" alt="Cover">`;
        }
        
        previewContent.innerHTML = `
            ${imageHtml}
            <h1 class="text-3xl font-bold text-white mb-4">${judul}</h1>
            <div class="text-gray-300 leading-relaxed whitespace-pre-line">${isi}</div>
        `;
        
        document.getElementById('previewModal').classList.remove('hidden');
    }

    function closePreview() {
        document.getElementById('previewModal').classList.add('hidden');
    }

    // Notification System
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-xl shadow-lg text-white font-semibold z-50 transform translate-x-full transition-transform duration-300 ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        notification.innerHTML = `
            <div class="flex items-center space-x-2">
                <i class="fas fa-${type === 'success' ? 'check' : 'exclamation-triangle'}"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Auto-save functionality (simulated)
    let autoSaveTimer;
    textarea.addEventListener('input', () => {
        clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(() => {
            showNotification('Progress tersimpan otomatis', 'success');
        }, 3000);
    });

    // Form validation
    document.getElementById('articleForm').addEventListener('submit', function(e) {
        const judul = judulInput.value.trim();
        const isi = textarea.value.trim();
        const kategori = document.getElementById('id_kategori').value;

        if (!judul) {
            e.preventDefault();
            showNotification('Judul artikel harus diisi!', 'error');
            judulInput.focus();
            return;
        }

        if (!kategori) {
            e.preventDefault();
            showNotification('Kategori harus dipilih!', 'error');
            document.getElementById('id_kategori').focus();
            return;
        }

        if (!isi) {
            e.preventDefault();
            showNotification('Isi artikel harus diisi!', 'error');
            textarea.focus();
            return;
        }

        showNotification('Menyimpan artikel...', 'success');
    });
</script>

<style>
    /* Custom scrollbar */
    textarea::-webkit-scrollbar {
        width: 8px;
    }

    textarea::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }

    textarea::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    textarea::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Custom select arrow */
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    /* Smooth focus transitions */
    input:focus, textarea:focus, select:focus {
        transition: all 0.3s ease;
    }

    /* Prose styling for preview */
    .prose {
        line-height: 1.75;
    }

    .prose p {
        margin-bottom: 1.25em;
    }

    .prose ul {
        margin-bottom: 1.25em;
        padding-left: 1.625em;
    }

    .prose li {
        margin-bottom: 0.5em;
    }
</style>
@endsection