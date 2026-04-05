      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Ircham Ali</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2021-<?= date('Y'); ?>&nbsp;
          <a href="https://github.com/pmiidev" class="text-decoration-none">DEV</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
   
    <!--Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <!--Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!--Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"
    ></script>
    <!--Plugin AdminLTE-->
    <script src="<?= base_url(''); ?>assets/lte4/js/adminlte.js"></script>
    
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>

    <!-- apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Data dari PHP
            const months = <?= $month; ?>;
            const values = <?= $value; ?>;

            // Debugging: Cek apakah data benar
            console.log("Months (before parsing):", months);
            console.log("Values:", values);

            // Pastikan format tanggal sesuai untuk datetime pada ApexCharts
            const formattedMonths = months.map(date => new Date(date).getTime());

            console.log("Months (after parsing):", formattedMonths);

            // Konfigurasi ApexCharts
            const options = {
                series: [
                    {
                        name: "Jumlah Pengunjung",
                        data: values,
                    },
                ],
                chart: {
                    height: 350,
                    type: "area",
                    toolbar: { show: false },
                },
                colors: ["#22baa0"],
                dataLabels: { enabled: false },
                stroke: { curve: "smooth" },
                xaxis: {
                    type: "datetime",
                    categories: formattedMonths, // Data sudah dalam format timestamp
                },
                tooltip: {
                    x: { format: "yyyy-MM-dd" },
                },
            };

            // Render chart
            const chart = new ApexCharts(document.querySelector("#visitor-chart"), options);
            chart.render();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Konversi data ke angka bulat
            const browserStats = {
                chrome: Math.round(<?= $chrome_visitor; ?>),
                firefox: Math.round(<?= $firefox_visitor; ?>),
                explorer: Math.round(<?= $explorer_visitor; ?>),
                safari: Math.round(<?= $safari_visitor; ?>),
                opera: Math.round(<?= $opera_visitor; ?>),
                robots: Math.round(<?= $robot_visitor; ?>),
                others: Math.round(<?= $other_visitor; ?>)
            };


            // Konfigurasi Pie Chart
            const pie_chart_options = {
                series: Object.values(browserStats), // Ambil nilai dari objek
                chart: {
                    type: 'donut',
                },
                labels: Object.keys(browserStats).map(name => name.charAt(0).toUpperCase() + name.slice(1)), // Ambil kunci objek sebagai label
                dataLabels: {
                    enabled: false,
                },
                colors: ['#0d6efd', '#20c997', '#dc3545', '#ffc107', '#6f42c1', '#198754', '#adb5bd'],
            };

            // Render Pie Chart
            const pie_chart = new ApexCharts(document.querySelector("#pie-chart"), pie_chart_options);
            pie_chart.render();
        });
    </script>
    <script>
      // Color Mode Toggler
      (() => {
        'use strict';

        const storedTheme = localStorage.getItem('theme');

        const getPreferredTheme = () => {
          if (storedTheme) {
            return storedTheme;
          }

          return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        };

        const setTheme = function (theme) {
          if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.setAttribute('data-bs-theme', 'dark');
          } else {
            document.documentElement.setAttribute('data-bs-theme', theme);
          }
        };

        setTheme(getPreferredTheme());

        const showActiveTheme = (theme, focus = false) => {
          const themeSwitcher = document.querySelector('#bd-theme');

          if (!themeSwitcher) {
            return;
          }

          const themeSwitcherText = document.querySelector('#bd-theme-text');
          const activeThemeIcon = document.querySelector('.theme-icon-active i');
          const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`);
          const svgOfActiveBtn = btnToActive.querySelector('i').getAttribute('class');

          for (const element of document.querySelectorAll('[data-bs-theme-value]')) {
            element.classList.remove('active');
            element.setAttribute('aria-pressed', 'false');
          }

          btnToActive.classList.add('active');
          btnToActive.setAttribute('aria-pressed', 'true');
          activeThemeIcon.setAttribute('class', svgOfActiveBtn);
          const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`;
          themeSwitcher.setAttribute('aria-label', themeSwitcherLabel);

          if (focus) {
            themeSwitcher.focus();
          }
        };

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
          if (storedTheme !== 'light' || storedTheme !== 'dark') {
            setTheme(getPreferredTheme());
          }
        });

        window.addEventListener('DOMContentLoaded', () => {
          showActiveTheme(getPreferredTheme());

          for (const toggle of document.querySelectorAll('[data-bs-theme-value]')) {
            toggle.addEventListener('click', () => {
              const theme = toggle.getAttribute('data-bs-theme-value');
              localStorage.setItem('theme', theme);
              setTheme(theme);
              showActiveTheme(theme, true);
            });
          }
        });
      })();
    </script>

    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>