<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title ?? 'Monitoring Pengeluaran Dana ORMAWA' }}</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Inter', 'system-ui', 'sans-serif'],
                },
                colors: {
                    primary: {
                        50: '#f0f9ff',
                        100: '#e0f2fe',
                        500: '#0ea5e9',
                        600: '#0284c7',
                        700: '#0369a1',
                        800: '#075985',
                        900: '#0c4a6e',
                    }
                }
            }
        }
    }
</script>
<style>
    html.dark body {
        background-color: #111827;
        /* gray-900 */
    }

    .sidebar-transition {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .nav-item {
        transition: all 0.2s ease-in-out;
    }

    .nav-item:hover {
        transform: translateX(4px);
    }

    .card-shadow {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }
</style>

@livewireStyles
