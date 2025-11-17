<?php
session_start();
if (!isset($_SESSION["login"])) { header("Location: index.php"); exit; }
$id = $_GET["id"] ?? -1;
if (!isset($_SESSION["kontak"][$id])) { header("Location: dashboard.php"); exit; }

$kontak = $_SESSION["kontak"][$id];
$err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama    = trim($_POST["nama"]);
    $email   = trim($_POST["email"]);
    $telepon = trim($_POST["telepon"]);
    $is_favorit = isset($_POST["favorit"]) ? true : false; 

    if ($nama === "") {
        $err = "Nama wajib diisi!";
    } else {
        $_SESSION["kontak"][$id] = ["nama" => $nama, "email" => $email, "telepon" => $telepon, "favorit" => $is_favorit];
        header("Location: dashboard.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Kontak - FR Hub</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
    .glass {
      background: linear-gradient(180deg, rgba(247,251,255,0.85), rgba(243,248,255,0.75));
      -webkit-backdrop-filter: blur(6px);
      backdrop-filter: blur(6px);
    }
    input:focus {
      outline: none;
      box-shadow: 0 6px 18px rgba(56, 189, 248, 0.06);
    }
    @keyframes kedip {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    .iklan-kedip {
        animation: kedip 1s infinite;
    }
</style>
</head>
<body class="min-h-screen" style="background-image:url('tm.png'); background-size:cover; background-position:fixed;">

<nav class="glass sticky top-0 z-50 shadow-md shadow-blue-100 border-b border-blue-100">
    <div class="container mx-auto flex justify-center items-center p-4 relative">
        
        <a href="logout.php" class="absolute left-4 text-2xl font-extrabold text-slate-800 hover:text-red-600 transition cursor-help" title="Awas! Ini tombol Logout terselubung!">
            FR Hub 
            <span class="text-xs font-normal text-red-500 block opacity-0 hover:opacity-100 transition-opacity">(Logout)</span>
        </a>
        
        <div class="flex space-x-8 items-center bg-white/50 px-8 py-3 rounded-full border border-white/60 shadow-lg backdrop-blur-md">
            <a href="dashboard.php" class="text-sm font-bold <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'text-blue-600' : 'text-slate-600 hover:text-blue-600'; ?> hover:scale-105 transition">Daftar Kontak</a>
            <span class="text-slate-300">|</span>
            <a href="tambah.php" class="text-sm font-bold <?php echo basename($_SERVER['PHP_SELF']) == 'tambah.php' ? 'text-blue-600' : 'text-slate-600 hover:text-blue-600'; ?> hover:scale-105 transition">Tambah Kontak</a>
        </div>

    </div>
</nav>

<div id="iklan-banner" class="container mx-auto px-4 mt-6 mb-6 transition-all duration-500">
    <div class="w-full bg-gradient-to-r from-yellow-300 via-orange-300 to-yellow-300 border-2 border-yellow-500 rounded-lg p-3 shadow-md text-center relative transform hover:scale-[1.01] transition">
        
        <button onclick="document.getElementById('iklan-banner').style.display='none'" 
                class="absolute top-0 right-2 text-red-600 hover:text-red-800 font-bold text-2xl leading-none focus:outline-none transition-colors"
                title="Tutup Iklan">
            &times;
        </button>

        <p class="font-bold text-red-600 text-lg uppercase tracking-widest">🔥 IKLAN: PROMO JASA CURHAT 24 JAM 🔥</p>
        <p class="text-sm text-slate-800 font-medium mt-1">
            Capek ngoding? Error mulu? Hubungi Favian sekarang! 
            <span class="bg-black text-yellow-300 px-2 rounded text-xs py-0.5 ml-1 iklan-kedip cursor-pointer">KLIK DISINI (BOHONGAN)</span>
        </p>
    </div>
</div>

<div class="container mx-auto p-4 md:p-8 flex justify-center">
    
    <div class="glass border border-blue-100 shadow-lg shadow-blue-200 rounded-2xl p-8 w-full max-w-lg">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-extrabold text-slate-800">Edit Kontak</h1>
            <p class="text-sm text-slate-500">Ubah detail kontak</p>
        </div>

        <?php if(!empty($err)): ?>
          <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
            <?= htmlspecialchars($err) ?>
          </div>
        <?php endif; ?>

        <form method="post" class="space-y-4">
            <div>
                <label for="nama" class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
                <input id="nama" name="nama" type="text" value="<?= htmlspecialchars($kontak['nama']) ?>" required
                  class="w-full py-2.5 px-3 rounded-lg bg-[#f0f6ff] border <?php echo !empty($err) ? 'border-red-400' : 'border-blue-200'; ?> text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email (Opsional)</label>
                <input id="email" name="email" type="email" value="<?= htmlspecialchars($kontak['email'] ?? '') ?>"
                  class="w-full py-2.5 px-3 rounded-lg bg-[#f0f6ff] border border-blue-200 text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition">
            </div>
            
            <div>
                <label for="telepon" class="block text-sm font-medium text-slate-700 mb-1">Telepon</label>
                <input id="telepon" name="telepon" type="text" value="<?= htmlspecialchars($kontak['telepon']) ?>" required
                  class="w-full py-2.5 px-3 rounded-lg bg-[#f0f6ff] border border-blue-200 text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition">
            </div>

            <div class="flex items-center justify-between text-sm pt-2">
                <label class="inline-flex items-center gap-2 text-slate-600">
                    <?php $checked = (isset($kontak['favorit']) && $kontak['favorit'] === true) ? 'checked' : ''; ?>
                    <input type="checkbox" name="favorit" class="h-4 w-4 text-blue-500 rounded border-slate-300 focus:ring-blue-300" <?= $checked ?>>
                    <span>Jadikan Favorit</span>
                </label>
            </div>

            <div class="flex items-center space-x-4 pt-4">
                <button type="submit" 
                  class="w-full bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-semibold py-2.5 rounded-lg shadow-md shadow-blue-300 transition">
                  Simpan Perubahan
                </button>
                <a href="dashboard.php" class="w-full text-center text-slate-600 hover:text-slate-800 font-medium py-2.5 rounded-lg">Batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>