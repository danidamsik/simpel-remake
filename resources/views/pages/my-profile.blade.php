<x-layouts.admin title="Profile">
    <!-- Container utama dengan padding dan max-width untuk responsivitas -->
    <div class="container mx-auto max-w-4xl">
          @livewire('profile.informasi')
    </div>

    <!-- Alpine.js Script -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('profileForm', () => ({
                // State untuk toggle password visibility
                showOldPassword: false,
                showNewPassword: false,
                showConfirmPassword: false,

                // State untuk input password
                oldPassword: '',
                newPassword: '',
                confirmPassword: '',

                // State untuk kekuatan password
                passwordStrength: 0,
                passwordHint: 'Minimal 8 karakter dengan kombinasi huruf dan angka',

                // Computed property untuk cek kecocokan password
                get passwordMatches() {
                    if (!this.newPassword || !this.confirmPassword) return false;
                    return this.newPassword === this.confirmPassword;
                },

                // Method untuk mengecek kekuatan password
                checkPasswordStrength() {
                    const password = this.newPassword;

                    if (!password) {
                        this.passwordStrength = 0;
                        this.passwordHint = 'Minimal 8 karakter dengan kombinasi huruf dan angka';
                        return;
                    }

                    let strength = 0;
                    let hint = '';

                    // Check length
                    if (password.length >= 8) strength++;

                    // Check for lowercase letters
                    if (/[a-z]/.test(password)) strength++;

                    // Check for uppercase letters
                    if (/[A-Z]/.test(password)) strength++;

                    // Check for numbers
                    if (/[0-9]/.test(password)) strength++;

                    // Check for special characters
                    if (/[^A-Za-z0-9]/.test(password)) strength++;

                    // Cap strength at 4 for the indicator
                    this.passwordStrength = Math.min(strength, 4);

                    // Set hint based on strength
                    switch (this.passwordStrength) {
                        case 1:
                            hint = 'Password sangat lemah';
                            break;
                        case 2:
                            hint = 'Password lemah';
                            break;
                        case 3:
                            hint = 'Password cukup kuat';
                            break;
                        case 4:
                            hint = 'Password sangat kuat';
                            break;
                        default:
                            hint = 'Minimal 8 karakter dengan kombinasi huruf dan angka';
                    }

                    this.passwordHint = hint;
                }
            }));
        });
    </script>
</x-layouts.admin>
