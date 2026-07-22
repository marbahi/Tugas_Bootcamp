<?php
$errors = [];
$data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $harga = trim($_POST['harga'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');

    if ($nama === '') $errors[] = 'Nama produk harus diisi.';
    if ($harga === '') $errors[] = 'Harga produk harus diisi.';
    if ($deskripsi === '') $errors[] = 'Deskripsi produk harus diisi.';

    if (empty($errors)) {
        $data = [
            'nama' => $nama,
            'harga' => $harga,
            'deskripsi' => $deskripsi,
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru</title>
    <style>
        * { box-sizing: border-box; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 24px 16px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 540px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.06);
            padding: 24px 20px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 1.35rem;
            margin: 0 0 20px;
            color: #0f172a;
        }

        h2 {
            font-size: 1.1rem;
            margin: 0 0 12px;
            color: #0f172a;
        }

        label {
            display: block;
            font-size: .875rem;
            font-weight: 600;
            margin-top: 16px;
            color: #1e293b;
        }
        label:first-of-type { margin-top: 0; }

        input, textarea {
            width: 100%;
            padding: 10px 12px;
            margin-top: 6px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: .925rem;
            font-family: inherit;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        input:focus, textarea:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99,102,241,.15);
        }

        textarea { height: 100px; resize: vertical; }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 11px 0;
            background: #6366f1;
            color: #fff;
            font-size: .95rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background .2s;
        }
        button:hover { background: #4f46e5; }

        .alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 20px;
        }
        .alert p {
            margin: 4px 0;
            font-size: .875rem;
            color: #b91c1c;
        }

        .output-card {
            background: #0f172a;
            border-radius: 8px;
            padding: 16px;
            margin-top: 20px;
        }
        .output-card pre {
            margin: 0;
            color: #e2e8f0;
            font-size: .85rem;
            font-family: 'JetBrains Mono', 'Fira Code', 'Consolas', monospace;
            white-space: pre-wrap;
            word-break: break-word;
        }

        @media (min-width: 600px) {
            body { padding: 40px 24px; }
            .card { padding: 32px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Tambah Produk Baru</h1>

            <?php if (!empty($errors)): ?>
                <div class="alert">
                    <?php foreach ($errors as $e): ?>
                        <p><?= htmlspecialchars($e) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="post">
                <label for="nama">Nama Produk</label>
                <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">

                <label for="harga">Harga</label>
                <input type="text" id="harga" name="harga" value="<?= htmlspecialchars($_POST['harga'] ?? '') ?>">

                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi"><?= htmlspecialchars($_POST['deskripsi'] ?? '') ?></textarea>

                <button type="submit">Simpan</button>
            </form>
        </div>

        <?php if (!empty($data)): ?>
            <div class="card">
                <h2>Data Produk</h2>
                <div class="output-card">
                    <pre><?php print_r($data); ?></pre>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
