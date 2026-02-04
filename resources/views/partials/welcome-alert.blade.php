

@if(session('show_welcome'))

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Welcome 👋',
            html: `
                 <strong>Hello {{ session('welcome_name') }}</strong><br>
            {{ session('welcome_role') === 'admin'
                ? 'You have full control 🛠️'
                : 'Glad to have you onboard 🚀'
            }}
        `,
            timer: 4000,
            showConfirmButton: false,
            didOpen: () => {

                confetti({
                    particleCount: 120,
                    spread: 70,
                    origin: { y: 0.6 }
                });
            }
        });
    </script>
@endif
