<!-- Tambahkan di <head> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
   .theme-toggle-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: rgba(248, 249, 250, 0.6);
    backdrop-filter: blur(8px);
    color: #555;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 1px solid #ddd;
}

.theme-toggle-btn:hover {
    background-color: #fefefe;
    transform: scale(1.1);
    color: #0d6efd;
}

.theme-toggle-icon {
    font-size: 16px;
    transition: 0.3s ease-in-out;
}

.theme-dropdown {
    position: absolute;
    top: 45px;
    right: 0;
    background-color: #fff;
    border-radius: 12px;
    border: 1px solid #dee2e6;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    padding: 15px 20px;
    width: 220px;
    z-index: 999;
    display: none;
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.theme-dropdown label {
    font-size: 13px;
    font-weight: 600;
    color: #6c757d;
    margin-bottom: 8px;
    display: block;
}

.theme-options {
    display: flex;
    gap: 8px;
}

.theme-option {
    flex: 1;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #f1f3f5;
    padding: 6px 10px;
    font-size: 13px;
    font-weight: 500;
    color: #333;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.theme-option:hover {
    background-color: #e7f1ff;
    border-color: #0d6efd;
    color: #0d6efd;
}

.theme-option.active {
    background-color: #0d6efd;
    color: #fff;
    border-color: #0d6efd;
}

.faq-icon {
    font-size: 16px;
    background: rgba(248, 249, 250, 0.6);
    backdrop-filter: blur(8px);
    border-radius: 10px;
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #0d6efd;
    border: 1px solid #ddd;
    transition: all 0.3s ease;
}

.faq-icon:hover {
    background-color: #f0f8ff;
    transform: scale(1.1);
}
.language-options {
    margin-top: 5px;
}

.language-radio {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: #333;
    cursor: pointer;
    transition: 0.2s ease;
}

.language-radio input[type="radio"] {
    accent-color: #0d6efd;
    cursor: pointer;
}


</style>

<!-- Header -->
<div class="header-area bg-white border-bottom py-2 px-3">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Kiri: Judul -->
        <div class="d-flex align-items-center">
            <div class="nav-btn me-3">
                <span></span><span></span><span></span>
            </div>
            <h5 class="mb-0">Sistem Informasi Monitoring Tindak Lanjut</h5>
        </div>

        <!-- Kanan: FAQ dan Tema -->
        <div class="d-flex align-items-center gap-3 position-relative">
            <!-- Tombol FAQ -->
            <a href="/faq" class="faq-icon" title="Lihat Bantuan & FAQ">
                <i class="fas fa-circle-question"></i>
            </a>

            <!-- Toggle Tema -->
            <div class="position-relative">
                <a href="#" id="themeToggleBtn" class="theme-toggle-btn" title="Ganti Tema">
                    <i id="themeIcon" class="fas fa-moon theme-toggle-icon moon"></i>
                </a>

                <div id="themeDropdown" class="theme-dropdown shadow-sm">
    <!-- Tema -->
    <label>Tema</label>
    <div class="theme-options mb-3">
        <button class="theme-option" data-mode="light-mode">Terang</button>
        <button class="theme-option" data-mode="dark-mode">Gelap</button>
    </div>

    <!-- Bahasa -->
    <label>Bahasa</label>
    <div class="language-options d-flex flex-column gap-2">
        <label class="language-radio">
            <input type="radio" name="language" value="id" checked />
            <span>Indonesia</span>
        </label>
        <label class="language-radio">
            <input type="radio" name="language" value="en" />
            <span>Inggris</span>
        </label>
    </div>
</div>

            </div>
        </div>
    </div>
</div>

<script>
    const setTheme = (mode) => {
        document.body.classList.remove("light-mode", "dark-mode");
        if (mode !== "auto") document.body.classList.add(mode);

        const icon = document.getElementById("themeIcon");
        icon.className = mode === "dark-mode"
            ? "fas fa-sun theme-toggle-icon sun"
            : "fas fa-moon theme-toggle-icon moon";

        localStorage.setItem("theme", mode);
        highlightActiveOption(mode);
    }

    const highlightActiveOption = (mode) => {
        document.querySelectorAll(".theme-option").forEach(btn => {
            btn.classList.toggle("active", btn.dataset.mode === mode);
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        const savedTheme = localStorage.getItem("theme") || "auto";
        setTheme(savedTheme);

        const toggleBtn = document.getElementById("themeToggleBtn");
        const dropdown = document.getElementById("themeDropdown");

        toggleBtn.addEventListener("click", (e) => {
            e.preventDefault();
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        });

        document.querySelectorAll(".theme-option").forEach(btn => {
            btn.addEventListener("click", () => {
                setTheme(btn.dataset.mode);
                dropdown.style.display = "none";
            });
        });
        // Menyimpan pilihan bahasa
const langRadios = document.querySelectorAll('input[name="language"]');
const savedLang = localStorage.getItem("language") || "id";
document.querySelector(`input[value="${savedLang}"]`)?.setAttribute("checked", true);

langRadios.forEach(radio => {
    radio.addEventListener("change", (e) => {
        const selectedLang = e.target.value;
        localStorage.setItem("language", selectedLang);
        // Opsional: reload atau ubah bahasa tampilan secara langsung
        console.log("Bahasa dipilih:", selectedLang);
    });
});


        // Close dropdown if clicked outside
        document.addEventListener("click", (e) => {
            if (!toggleBtn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = "none";
            }
        });
    });
</script>
