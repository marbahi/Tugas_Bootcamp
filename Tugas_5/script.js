const products = [
  {
    id: 1,
    name: "Laptop Pro",
    price: 15000000,
    description: "Laptop performa tinggi untuk kerja dan gaming.",
    image: "Assets/laptop.jpg",
    category: "Elektronik"
  },
  {
    id: 2,
    name: "Headphone Wireless",
    price: 500000,
    description: "Headphone Bluetooth dengan noise cancelling.",
    image: "Assets/headphone.jpg",
    category: "Elektronik"
  },
  {
    id: 3,
    name: "Smartphone X",
    price: 8000000,
    description: "Smartphone layar AMOLED 6.5 inci, kamera 108MP.",
    image: "Assets/smartphone.jpg",
    category: "Elektronik"
  },
  {
    id: 4,
    name: "Speaker Bluetooth",
    price: 350000,
    description: "Speaker portabel dengan bass kuat, tahan air.",
    image: "Assets/speaker bluetooth.jpg",
    category: "Elektronik"
  },
  {
    id: 5,
    name: "Kaos Polos",
    price: 75000,
    description: "Kaos katun nyaman, tersedia berbagai warna.",
    image: "Assets/kaos polos.jpg",
    category: "Pakaian"
  },
  {
    id: 6,
    name: "Jaket Denim",
    price: 250000,
    description: "Jaket denim klasik cocok untuk santai.",
    image: "Assets/jaket denim.jpg",
    category: "Pakaian"
  },
  {
    id: 7,
    name: "Celana Chino",
    price: 180000,
    description: "Celana chino bahan stretch, nyaman seharian.",
    image: "Assets/celana chino.jpg",
    category: "Pakaian"
  },
  {
    id: 8,
    name: "Topi Baseball",
    price: 55000,
    description: "Topi baseball adjustable, bahan katun premium.",
    image: "Assets/topi baseball.jpg",
    category: "Pakaian"
  },
  {
    id: 9,
    name: "Kopi Arabika",
    price: 45000,
    description: "Kopi bubuk arabika pilihan dari Jawa Barat.",
    image: "Assets/kopi arabica.jpg",
    category: "Makanan"
  },
  {
    id: 10,
    name: "Cokelat Premium",
    price: 35000,
    description: "Cokelat hitam 70% kakao, imported from Belgium.",
    image: "Assets/coklat premium.jpg",
    category: "Makanan"
  },
  {
    id: 11,
    name: "Teh Hijau",
    price: 25000,
    description: "Teh hijau organik dari perkebunan lokal.",
    image: "Assets/teh hijau.jpg",
    category: "Makanan"
  },
  {
    id: 12,
    name: "Keripik Singkong",
    price: 15000,
    description: "Keripik singkong gurih, camilan renyah favorit.",
    image: "Assets/keripik singkong.jpg",
    category: "Makanan"
  }
];

function formatRupiah(angka) {
  return new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0
  }).format(angka);
}

function renderProducts(items) {
  const container = document.getElementById("product-list");
  container.innerHTML = "";

  if (items.length === 0) {
    container.innerHTML = `<div class="col-12 text-center py-5"><p class="fs-4 text-muted">Produk tidak ditemukan.</p></div>`;
    return;
  }

  items.forEach(product => {
    const col = document.createElement("div");
    col.className = "col-6 col-md-4 mb-4";

    col.innerHTML = `
      <div class="card h-100 shadow-sm border-0">
        <img src="${product.image}" class="card-img-top" alt="${product.name}" style="height: 220px; object-fit: cover;">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">${product.name}</h5>
          <p class="card-text text-muted">${product.description}</p>
          <p class="fw-bold text-primary mt-auto mb-0 fs-5">${formatRupiah(product.price)}</p>
          <button class="btn btn-primary mt-3">Beli</button>
        </div>
      </div>
    `;

    container.appendChild(col);
  });
}

let activeCategory = "all";

function renderFiltered() {
  let result = products;

  if (activeCategory !== "all") {
    result = result.filter(p => p.category === activeCategory);
  }

  const query = document.getElementById("searchInput").value.trim().toLowerCase();
  if (query) {
    result = result.filter(p => p.name.toLowerCase().includes(query));
  }

  renderProducts(result);
}

document.addEventListener("DOMContentLoaded", () => {
  renderProducts(products);

  document.querySelectorAll("#filter-menu .dropdown-item").forEach(item => {
    item.addEventListener("click", e => {
      e.preventDefault();
      activeCategory = item.getAttribute("data-category");
      const label = activeCategory === "all" ? "Semua" : activeCategory;
      document.getElementById("filterDropdown").textContent = `Filter: ${label}`;
      renderFiltered();
    });
  });

  document.getElementById("searchBtn").addEventListener("click", renderFiltered);
  document.getElementById("searchInput").addEventListener("keyup", e => {
    if (e.key === "Enter") renderFiltered();
  });

  document.getElementById("brand-link").addEventListener("click", e => {
    e.preventDefault();
    activeCategory = "all";
    document.getElementById("filterDropdown").textContent = "Filter: Semua";
    document.getElementById("searchInput").value = "";
    renderProducts(products);
  });
});
