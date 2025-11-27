# Instruksi Mengganti Gambar Ilustrasi

## Langkah-langkah:

1. **Copy gambar "Young boy posing remembering something vector illustration"** ke folder:
   ```
   c:\laragon\www\e-mading\public\images\young-boy-thinking.jpg
   ```

2. **Pastikan nama file adalah:** `young-boy-thinking.jpg`

3. **Untuk hasil terbaik:**
   - Gunakan gambar dengan background transparan (PNG) atau background putih
   - Resolusi minimal 800x600 pixels
   - Format JPG atau PNG

4. **Jika ingin mengganti dengan gambar lain:**
   - Ganti path di file: `resources/views/Auth/login.blade.php`
   - Ganti path di file: `resources/views/Auth/register.blade.php`
   - Cari baris: `src="{{ asset('images/young-boy-thinking.jpg') }}"`

## Efek yang Diterapkan:
- Drop shadow untuk kedalaman
- Hover effect dengan scale dan brightness
- Mix blend mode untuk integrasi dengan background
- Border radius untuk tampilan modern

## Hasil:
- Gambar akan menggantikan ilustrasi SVG lama
- Background akan terlihat terpotong/terintegrasi dengan baik
- Animasi hover saat mouse diarahkan ke gambar