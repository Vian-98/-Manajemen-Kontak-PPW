<?php
session_start();
$err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $u = $_POST["username"] ?? "";
    $p = $_POST["password"] ?? "";

    if ($u === "favian" && $p === "favian") {
        $_SESSION["login"] = true;
        $_SESSION["username"] = $u;

        if (!isset($_SESSION["kontak"])) {
            $_SESSION["kontak"] = [];
        }

        header("Location: dashboard.php");
        exit;
    } else {
        $err = "Username atau password salah!";
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Login - FR Hub</title>
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
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4" style="background-image:url('tm.png'); background-size:cover; background-position:center;">

  <div class="w-full flex items-center justify-center">
      <div class="glass border border-blue-100 shadow-lg shadow-blue-200 rounded-2xl p-8 w-full max-w-md">
        <div class="text-center mb-4">
          <h1 class="text-2xl font-extrabold text-slate-800">FR Hub</h1>
          <p class="text-sm text-slate-500">Silakan login untuk melanjutkan</p>
        </div>

        <?php if(!empty($err)): ?>
          <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
            <?= htmlspecialchars($err) ?>
          </div>
        <?php endif; ?>

        <form method="post" class="space-y-4">
          <div>
            <label for="username" class="block text-sm font-medium text-slate-700 mb-1">Username</label>
            <input id="username" name="username" type="text" required
              class="w-full py-2.5 px-3 rounded-lg bg-[#f0f6ff] border border-blue-200 text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition" 
              placeholder="Masukkan username">
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
            <input id="password" name="password" type="password" required
              class="w-full py-2.5 px-3 rounded-lg bg-[#f0f6ff] border border-blue-200 text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition" 
              placeholder="Masukkan password">
          </div>

          <div>
            <button type="submit" 
              class="w-full bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-semibold py-2.5 rounded-lg shadow-md shadow-blue-300 transition">
              Masuk
            </button>
          </div>
        </form>
    </div>
  </div>

</body>
</html>
