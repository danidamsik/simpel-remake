<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login - SIMPEL ORMAWA' }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Gradient Background */
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        }

        /* Glass Effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        /* Animated Background Shapes */
        .bg-shapes::before,
        .bg-shapes::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.6;
        }

        .bg-shapes::before {
            width: 400px;
            height: 400px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            top: -100px;
            right: -100px;
            animation: float 8s ease-in-out infinite;
        }

        .bg-shapes::after {
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, #f093fb, #f5576c);
            bottom: -50px;
            left: -50px;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-30px) rotate(10deg);
            }
        }

        /* Input Focus Animation */
        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 40px -10px rgba(102, 126, 234, 0.5);
        }

        /* Button Hover Effect */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 40px -10px rgba(102, 126, 234, 0.7);
        }

        .btn-primary:active {
            transform: translateY(0);
        }
    </style>

    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen gradient-bg bg-shapes relative overflow-hidden flex items-center justify-center p-4">
        {{ $slot }}
    </div>

    @livewireScripts
</body>

</html>
