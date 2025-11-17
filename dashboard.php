<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

$kontak_list = $_SESSION["kontak"] ?? [];
$favorit_kontak = [];
$biasa_kontak = [];

foreach ($kontak_list as $i => $k) {
    $k['original_id'] = $i; 
    if (isset($k['favorit']) && $k['favorit'] === true) {
        $favorit_kontak[] = $k;
    } else {
        $biasa_kontak[] = $k;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard - FR Hub</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
    .glass {
      background: linear-gradient(180deg, rgba(247,251,255,0.85), rgba(243,248,255,0.75));
      -webkit-backdrop-filter: blur(6px);
      backdrop-filter: blur(6px);
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

<div class="container mx-auto py-8 px-4">
    <div class="max-w-4xl mx-auto space-y-6">

        <div class="flex flex-row gap-4 items-center">
            <div class="glass border border-blue-100 shadow-lg shadow-blue-200 rounded-2xl p-4 w-full flex-1">
                 <input type="text" class="w-full py-2.5 px-3 rounded-lg bg-[#f0f6ff] border border-blue-200 text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition" 
                 placeholder="Cari nama atau telepon...">
            </div>

            <a href="tambah.php" class="flex-shrink-0 w-14 h-14 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-semibold rounded-lg shadow-md shadow-blue-300 transition flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
            </a>
        </div>

        <div class="space-y-6">
            <?php if (!empty($favorit_kontak)): ?>
                <h3 class="text-xl font-bold text-slate-800 mb-4 drop-shadow-md">Favorit</h3>
                <div class="space-y-4">
                    <?php foreach ($favorit_kontak as $k): ?>
                        <div class="glass border border-yellow-200 shadow-lg shadow-yellow-100 rounded-2xl p-4 flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex-grow">
                                <div class="flex items-center gap-2">
                                    <a href="toggle_favorit.php?id=<?= $k['original_id'] ?>" class="text-yellow-400 hover:text-yellow-500">★</a>
                                    <h4 class="text-lg font-semibold text-slate-800"><?= htmlspecialchars($k["nama"]) ?></h4>
                                </div>
                                <div class="pl-6 mt-1 space-y-0.5">
                                    <p class="text-slate-600 truncate text-sm">✉ <?= htmlspecialchars($k["email"]) ?></p>
                                    <p class="text-slate-600 truncate text-sm">📞 <?= htmlspecialchars($k["telepon"]) ?></p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 flex space-x-3 mt-4 md:mt-0 md:pl-4 self-end md:self-center">
                                <a href="edit.php?id=<?= $k['original_id'] ?>" class="text-blue-600 hover:underline font-medium text-sm">Edit</a>
                                <a href="hapus.php?id=<?= $k['original_id'] ?>" class="text-red-500 hover:underline font-medium text-sm">Hapus</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <h3 class="text-xl font-bold text-slate-800 mb-4 drop-shadow-md">Semua Kontak</h3>
            <?php if (empty($biasa_kontak) && empty($favorit_kontak)): ?>
                <div class="glass border border-blue-100 shadow-lg shadow-blue-200 rounded-2xl p-8 text-center">
                    <p class="text-slate-700">Belum ada kontak.</p>
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($biasa_kontak as $k): ?>
                        <div class="glass border border-blue-100 shadow-lg shadow-blue-200 rounded-2xl p-4 flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex-grow">
                                <div class="flex items-center gap-2">
                                    <a href="toggle_favorit.php?id=<?= $k['original_id'] ?>" class="text-gray-400 hover:text-yellow-400">☆</a>
                                    <h4 class="text-lg font-semibold text-slate-800"><?= htmlspecialchars($k["nama"]) ?></h4>
                                </div>
                                <div class="pl-6 mt-1 space-y-0.5">
                                    <p class="text-slate-600 truncate text-sm">✉ <?= htmlspecialchars($k["email"]) ?></p>
                                    <p class="text-slate-600 truncate text-sm">📞 <?= htmlspecialchars($k["telepon"]) ?></p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 flex space-x-3 mt-4 md:mt-0 md:pl-4 self-end md:self-center">
                                <a href="edit.php?id=<?= $k['original_id'] ?>" class="text-blue-600 hover:underline font-medium text-sm">Edit</a>
                                <a href="hapus.php?id=<?= $k['original_id'] ?>" class="text-red-500 hover:underline font-medium text-sm">Hapus</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>