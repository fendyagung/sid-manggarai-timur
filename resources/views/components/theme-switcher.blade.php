<div class="flex items-center gap-2">
    <button id="theme-toggle" type="button"
        class="nav-text-white text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-200 dark:focus:ring-slate-700 rounded-lg text-sm p-2.5 transition-all duration-300 flex items-center gap-2">
        <!-- Icons -->
        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 nav-text-white" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
        </svg>
        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 nav-text-white" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path>
        </svg>
        <span id="theme-toggle-text" class="nav-text-white text-[10px] font-black uppercase tracking-widest text-slate-700 dark:text-slate-200">Mode Gelap</span>
    </button>
</div>

<script>
    (function() {
        const themeToggleBtns = document.querySelectorAll('#theme-toggle');

        function syncIcons() {
            const isDark = document.documentElement.classList.contains('dark');
            
            document.querySelectorAll('#theme-toggle-dark-icon').forEach(el => {
                isDark ? el.classList.add('hidden') : el.classList.remove('hidden');
            });
            document.querySelectorAll('#theme-toggle-light-icon').forEach(el => {
                isDark ? el.classList.remove('hidden') : el.classList.add('hidden');
            });
            document.querySelectorAll('#theme-toggle-text').forEach(el => {
                el.innerText = isDark ? 'MODE GELAP' : 'MODE TERANG';
            });
        }

        syncIcons();

        themeToggleBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
                syncIcons();
            });
        });
    })();
</script>