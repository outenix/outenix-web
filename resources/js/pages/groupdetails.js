import { showNotification } from '../utils/notification.js';

export function handleDetailGroups() {
    const groupDetailTopUsers = document.getElementById('groupDetailTopUsers');
    const groupDetailHistory = document.getElementById('groupDetailHistory');
    const groupDetailProfile = document.getElementById('groupDetailProfile');
    const groupDetailStatistic = document.getElementById('groupDetailStatistic');
    const groupDetailContainer = document.getElementById('groupDetailContainer');

    const sidebarGroupDetailTopUsers = document.getElementById('sidebarGroupDetailTopUsers');
    const sidebarGroupDetailHistory = document.getElementById('sidebarGroupDetailHistory');
    const sidebarGroupDetailProfile = document.getElementById('sidebarGroupDetailProfile');
    const sidebarGroupDetailStatistic = document.getElementById('sidebarGroupDetailStatistic');

    let isLoading = false;
    let page = 1; // Default halaman awal

    // Ambil parameter terakhir dari URL
    const urlSegments = window.location.pathname.split('/');
    const groupId = urlSegments[urlSegments.length - 1];

    if (!window.fetch) {
        showNotification("Browser Anda tidak mendukung fitur ini.", "error");
        return;
    }

    function resetClasses() {
        const buttons = [groupDetailTopUsers, groupDetailHistory, groupDetailProfile, groupDetailStatistic];
        buttons.forEach(el => {
            if (el) {
                el.className = 'group flex space-x-2 rounded-lg p-2 tracking-wide text-slate-800 outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:text-navy-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600';
                const svg = el.querySelector('svg');
                if (svg) {
                    svg.classList.add('text-slate-400', 'transition-colors', 'group-hover:text-slate-500', 'group-focus:text-slate-500', 'dark:text-navy-300', 'dark:group-hover:text-navy-200', 'dark:group-focus:text-navy-200');
                }
            }
        });

        const sidebarButtons = [sidebarGroupDetailTopUsers, sidebarGroupDetailHistory, sidebarGroupDetailProfile, sidebarGroupDetailStatistic];
        sidebarButtons.forEach(el => {
            if (el) {
                el.className = 'btn h-10 w-10 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25';
            }
        });
    }

    function setActiveButton(activeButton, sidebarButton = null) {
        resetClasses();
        activeButton.className = 'group flex space-x-2 rounded-lg bg-primary/10 p-2 tracking-wide text-primary outline-none transition-all dark:bg-accent-light/10 dark:text-accent-light';
        const svg = activeButton.querySelector('svg');
        if (svg) {
            svg.classList.remove('text-slate-400', 'group-hover:text-slate-500', 'group-focus:text-slate-500', 'dark:text-navy-300', 'dark:group-hover:text-navy-200', 'dark:group-focus:text-navy-200');
        }

        if (sidebarButton) {
            sidebarButton.className = 'btn h-10 w-10 bg-primary/10 p-0 font-medium text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-accent-light/10 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25';
        }
    }

    function loadContent(url, activeButton, sidebarButton = null) {
        if (isLoading) return;
        isLoading = true;

        setActiveButton(activeButton, sidebarButton);

        const spinner = document.createElement('span');
        spinner.className = 'ml-auto spinner h-4 w-4 animate-spin rounded-full border-[3px] border-primary border-r-transparent';
        activeButton.appendChild(spinner);

        fetch(url, { method: 'GET', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(response => {
                if (response.status === 200 && response.url.includes("/login")) {
                    showNotification('Kamu telah keluar dari perangkat', 'error');
                    window.location.href = '/login';
                    return;
                }
                if (!response.ok) throw new Error('Terjadi kesalahan saat memuat konten.');
                return response.text();
            })
            .then(html => {
                groupDetailContainer.innerHTML = html;
                page = 1; // Reset halaman saat konten baru dimuat
            })
            .catch(() => {
                showNotification('Terjadi kesalahan saat memuat konten.', 'error');
            })
            .finally(() => {
                isLoading = false;
                activeButton.removeChild(spinner);
            });
    }

    function updateBreadcrumb(label) {
        const breadcrumb = document.getElementById('breadcrumb');
        if (breadcrumb) breadcrumb.textContent = label;
    }

    function addElementClick(targetElement, sidebarElement, endpoint, label) {
        // Jika endpoint adalah "top-users", tambahkan "/1" di akhir URL
        const url = endpoint === "top-users" 
            ? `/group-details/${endpoint}/${groupId}/1/asc/all` 
            : `/group-details/${endpoint}/${groupId}`;
    
        if (targetElement) {
            targetElement.addEventListener('click', e => {
                e.preventDefault();
                loadContent(url, targetElement, sidebarElement);
                updateBreadcrumb(label);
            });
        }
    
        if (sidebarElement) {
            sidebarElement.addEventListener('click', e => {
                e.preventDefault();
                loadContent(url, targetElement, sidebarElement);
                updateBreadcrumb(label);
            });
        }
    }    

    addElementClick(groupDetailTopUsers, sidebarGroupDetailTopUsers, 'top-users', 'Top Pengguna');
    addElementClick(groupDetailHistory, sidebarGroupDetailHistory, 'history', 'Riwayat');
    addElementClick(groupDetailProfile, sidebarGroupDetailProfile, 'profile', 'Profil');
    addElementClick(groupDetailStatistic, sidebarGroupDetailStatistic, 'statistic', 'Statistik');

    if (groupDetailContainer) {
        const redirect = groupDetailContainer.dataset.redirect;
        const message = groupDetailContainer.dataset.msg;

        if (message) {
            let messageType = 'info';
            if (groupDetailContainer.dataset.errorMessage) messageType = 'error';
            else if (groupDetailContainer.dataset.warningMessage) messageType = 'warning';
            else if (groupDetailContainer.dataset.successMessage) messageType = 'success';
            showNotification(message, messageType);
        }

        const redirectMap = {
            groupDetailHistory: [`/group-details/history/${groupId}`, groupDetailHistory, sidebarGroupDetailHistory],
            groupDetailProfile: [`/group-details/profile/${groupId}`, groupDetailProfile, sidebarGroupDetailProfile],
            groupDetailStatistic: [`/group-details/statistic/${groupId}`, groupDetailStatistic, sidebarGroupDetailStatistic],
            default: [`/group-details/top-users/${groupId}/1/asc/all`, groupDetailTopUsers, sidebarGroupDetailTopUsers]
        };

        const [url, target, sidebar] = redirectMap[redirect] || redirectMap.default;
        loadContent(url, target, sidebar);
    }
}

export function handlePaginationTopUsers() {
    const groupDetailContainer = document.getElementById("groupDetailContainer");
    if (!groupDetailContainer) return;

    const groupId = groupDetailContainer.dataset.group;
    if (!groupId) return;

    let isLoading = false;

    function loadPage(page) {
        if (isLoading) return;
        isLoading = true;

        const url = `/group-details/p/top-users/${groupId}/${page}/asc/all`;

        fetch(url, { method: "GET", headers: { "X-Requested-With": "XMLHttpRequest" } })
            .then((response) => {
                if (response.status === 200 && response.url.includes("/login")) {
                    showNotification("Kamu telah keluar dari perangkat", "error");
                    window.location.href = "/login";
                    return;
                }
                if (!response.ok) throw new Error("Terjadi kesalahan saat memuat konten.");
                return response.text();
            })
            .then((html) => {
                if (html) {
                    paginationContainer.innerHTML = html;
                }
            })
            .catch(() => {
                showNotification("Terjadi kesalahan saat memuat data.", "error");
            })
            .finally(() => {
                isLoading = false;
            });
    }

    function handleClick(event) {
        event.preventDefault();
        const button = event.target.closest("button");
        if (!button || !button.dataset.page) return;

        const page = button.dataset.page;
        loadPage(page);
    }

    document.body.addEventListener("click", (event) => {
        if (event.target.closest("#btnPaginationContainer button")) {
            handleClick(event);
        }
    });

    const observer = new MutationObserver(() => {
        const paginationContainer = document.getElementById("paginationContainer");
    });

    observer.observe(groupDetailContainer, { childList: true, subtree: true });
}

export function handlePaginationSort() {
    const groupDetailContainer = document.getElementById("groupDetailContainer");
    if (!groupDetailContainer) return;

    const groupId = groupDetailContainer.dataset.group;
    if (!groupId) return;

    let currentSort = "asc";
    let isLoading = false;

    function loadSort(sort, search) {
        if (isLoading) return;
        isLoading = true;

        search = search || "all"; 
        const url = `/group-details/p/top-users/${groupId}/1/${sort}/${search}`;

        fetch(url, { method: "GET", headers: { "X-Requested-With": "XMLHttpRequest" } })
            .then((response) => {
                if (response.status === 200 && response.url.includes("/login")) {
                    showNotification("Kamu telah keluar dari perangkat", "error");
                    window.location.href = "/login";
                    return;
                }
                if (!response.ok) throw new Error("Terjadi kesalahan saat memuat konten.");
                return response.text();
            })
            .then((html) => {
                if (html) {
                    paginationContainer.innerHTML = html;
                }
            })
            .catch(() => {
                showNotification("Terjadi kesalahan saat memuat data.", "error");
            })
            .finally(() => {
                isLoading = false;
            });
    }

    function handleClick() {
        if (isLoading) return;

        currentSort = currentSort === "desc" ? "asc" : "desc";

        // Ambil nilai search dari data-search
        const searchInput = document.getElementById("searchTopUsersGroup");
        const search = searchInput?.dataset.search || "all";

        loadSort(currentSort, search);

        const sortButton = document.getElementById("sortPage");
        if (sortButton) {
            const iconClass = currentSort === "asc" ? "fa-arrow-up-big-small" : "fa-arrow-up-small-big";
            sortButton.innerHTML = `<i class="fa-regular ${iconClass} h-5 w-5"></i>`;
            sortButton.setAttribute("data-sort", currentSort);
            
            if (currentSort === "desc") {
                sortButton.classList.add("bg-primary", "text-white");
            } else {
                sortButton.classList.remove("bg-primary", "text-white");
            }
        }
    }

    const observer = new MutationObserver(() => {
        const sortButton = document.getElementById("sortPage");
        if (sortButton) {
            sortButton.addEventListener("click", handleClick);
        }

        const searchInput = document.getElementById("searchTopUsersGroup");
        if (searchInput) {
            searchInput.addEventListener("input", () => {
                // Update data-search setiap input berubah
                searchInput.dataset.search = searchInput.value.trim() || "all";
            });
        }
    });

    observer.observe(groupDetailContainer, { childList: true, subtree: true });
}

export function handlePaginationSearch() {
    const groupDetailContainer = document.getElementById("groupDetailContainer");
    if (!groupDetailContainer) return;

    const groupId = groupDetailContainer.dataset.group;
    if (!groupId) return;

    let currentSort = "asc";
    let isLoading = false;

    function loadSearch(search) {
        if (isLoading) return;
        isLoading = true;

        search = search || "ALL"; 
        const url = `/group-details/p/top-users/${groupId}/1/${currentSort}/${search}`;

        fetch(url, { method: "GET", headers: { "X-Requested-With": "XMLHttpRequest" } })
            .then((response) => {
                if (response.status === 200 && response.url.includes("/login")) {
                    showNotification("Kamu telah keluar dari perangkat", "error");
                    window.location.href = "/login";
                    return;
                }
                if (!response.ok) throw new Error("Terjadi kesalahan saat memuat konten.");
                return response.text();
            })
            .then((html) => {
                if (html) {
                    paginationContainer.innerHTML = html;
                }
            })
            .catch(() => {
                showNotification("Terjadi kesalahan saat memuat data.", "error");
            })
            .finally(() => {
                isLoading = false;
            });
    }

    function handleInput(event) {
        const search = event.target.value.trim() || "all";
        loadSearch(search);
    }

    const observer = new MutationObserver(() => {
        const searchInput = document.getElementById("searchTopUsersGroup");
        if (searchInput) {
            searchInput.addEventListener("input", handleInput);
        }

        const sortButton = document.getElementById("sortPage");
        if (sortButton) {
            let sortAttribute = sortButton.getAttribute("data-sort");
            currentSort = (sortAttribute === "asc" || sortAttribute === "desc") ? sortAttribute : "asc";
        }
    });

    observer.observe(groupDetailContainer, { childList: true, subtree: true });
}