<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register &mdash; </title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('templates/node_modules/selectric/public/selectric.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('templates/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/css/components.css') }}">
    <link href="{{ asset('templates/css/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">

    <!-- === Custom Modal CSS (no Bootstrap) === -->
    <style>
        :root {
            --cmz-backdrop: rgba(0,0,0,.5);
            --cmz-bg: #ffffff;
            --cmz-radius: 0.75rem;
            --cmz-shadow: 0 10px 30px rgba(0,0,0,.18);
            --cmz-z: 9999;
        }
        /* Backdrop */
        .cmz-backdrop {
            position: fixed;
            inset: 0;
            background: var(--cmz-backdrop);
            opacity: 0;
            pointer-events: none;
            transition: opacity .2s ease;
            z-index: var(--cmz-z);
        }
        .cmz-backdrop.cmz-open {
            opacity: 1;
            pointer-events: auto;
        }

        /* Modal container */
        .cmz-modal {
            position: fixed;
            inset: 0;
            display: grid;
            place-items: center;
            z-index: calc(var(--cmz-z) + 1);
            pointer-events: none; /* hanya aktif saat open */
        }
        .cmz-modal.cmz-open { pointer-events: auto; }

        /* Dialog */
        .cmz-dialog {
            width: min(800px, 92vw);
            max-height: 82vh;
            background: var(--cmz-bg);
            border-radius: var(--cmz-radius);
            box-shadow: var(--cmz-shadow);
            transform: translateY(8px) scale(.98);
            opacity: 0;
            transition: transform .22s ease, opacity .22s ease;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .cmz-open .cmz-dialog {
            transform: translateY(0) scale(1);
            opacity: 1;
        }

        .cmz-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 18px;
            border-bottom: 1px solid rgba(0,0,0,.08);
        }
        .cmz-title { margin: 0; font-size: 1.05rem; font-weight: 600; }
        .cmz-close {
            border: 0; background: transparent; font-size: 1.25rem;
            line-height: 1; cursor: pointer; opacity: .75;
        }
        .cmz-close:hover { opacity: 1; }

        .cmz-body {
            padding: 16px 18px;
            overflow: auto;
        }
        .cmz-footer {
            padding: 12px 18px;
            border-top: 1px solid rgba(0,0,0,.08);
            display: flex; justify-content: flex-end; gap: 8px;
        }

        /* Scroll lock helper */
        .cmz-lock { overflow: hidden !important; }

        /* Optional: link underline style */
        .terms-link {
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>

<body>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div
                    class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Register</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="first_name">First Name</label>
                                        <input id="first_name" type="text"
                                               class="form-control @error('first_name') is-invalid @enderror"
                                               name="first_name" autofocus required>
                                        @error('first_name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="last_name">Last Name</label>
                                        <input id="last_name" type="text"
                                               class="form-control @error('last_name') is-invalid @enderror"
                                               name="last_name" required>
                                        @error('last_name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input id="phone" type="tel"
                                           class="form-control @error('phone') is-invalid @enderror" name="phone"
                                           required>
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password">Password</label>
                                        <input id="password" type="password"
                                               class="form-control pwstrength @error('password') is-invalid @enderror"
                                               data-indicator="pwindicator" name="password">
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="password_confirmation">Password Confirmation</label>
                                        <input id="password_confirmation" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password_confirmation">
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Tambahan khusus untuk owner --}}
                                @if(request()->get('role') === 'owner')
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                   class="custom-control-input @error('agreement') is-invalid @enderror"
                                                   id="agreement"
                                                   name="agreement"
                                                   value="1"
                                                   required>
                                            <label class="custom-control-label" for="agreement">
                                                Saya menyetujui
                                                <a href="#" id="openTerms" class="terms-link">syarat & ketentuan</a>
                                            </label>
                                            @error('agreement')
                                            <div class="invalid-feedback d-block">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Register
                                    </button>
                                </div>

                                <div class="mt-5 text-center">
                                    Already have an account? <a href="{{ route('login') }}?role=customer">Log In</a>
                                </div>

                                @php $role = request()->get('role'); @endphp
                                @if($role === 'owner')
                                    <input type="hidden" name="role" value="owner">
                                @elseif($role === 'customer')
                                    <input type="hidden" name="role" value="customer">
                                @else
                                    <input type="hidden" name="role" value="admin">
                                @endif
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- === Custom Modal Markup (no Bootstrap) === -->
        <div id="cmzBackdrop" class="cmz-backdrop" aria-hidden="true"></div>

        <div id="cmzModal" class="cmz-modal" role="dialog" aria-modal="true" aria-labelledby="cmzTitle" aria-hidden="true">
            <div class="cmz-dialog" role="document">
                <div class="cmz-header">
                    <h5 id="cmzTitle" class="cmz-title">Syarat & Ketentuan</h5>
                    <button type="button" class="cmz-close" id="cmzCloseBtn" aria-label="Close">&times;</button>
                </div>
                <div class="cmz-body">
                    <li>
                    <strong>Program Poin untuk Customer</strong>
                    <ul class="mt-2 mb-0 pl-3">
                        <li><strong>Pemberian poin:</strong> Setiap kali customer menyelesaikan proses penyewaan lapangan melalui sistem, poin akan otomatis ditambahkan ke akun customer.</li>
                        <li><strong>Hak Owner:</strong> Dengan mendaftar sebagai <em>Owner</em>, Anda menyetujui penerapan fitur poin ini pada seluruh transaksi penyewaan lapangan yang dikelola melalui sistem.</li>
                        <li><strong>Aturan penukaran:</strong> Customer yang telah mengumpulkan minimal <em>1.000 poin</em> berhak menukarkan poin tersebut untuk memperoleh diskon senilai <em>1 (satu) jam</em> penggunaan.</li>
                        <li><strong>Kondisi berlaku:</strong> Diskon hanya dapat digunakan apabila customer melakukan penyewaan dengan durasi minimal <em>2 (dua) jam</em> dalam satu transaksi.</li>
                        <li><strong>Mekanisme:</strong> Pada saat customer menukarkan poin, sistem akan otomatis mengurangi <em>1.000 poin</em> dari saldo customer, dan biaya 1 jam akan dikurangkan dari total pembayaran.</li>
                        <li><strong>Kebijakan:</strong> Aturan dan ketentuan program poin dapat diperbarui sewaktu-waktu oleh pengelola sistem, dan Owner dianggap menyetujui penerapannya sebagai bagian dari layanan.</li>
                    </ul>
                    </li>
                </div>
                <div class="cmz-footer">
                    <button type="button" class="btn btn-secondary" id="cmzCloseFooter">Tutup</button>
                </div>
            </div>
        </div>
        <!-- === /Custom Modal === -->

    </section>
</div>

<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('templates/js/stisla.js') }}"></script>

<!-- JS Libraries -->
<script src="{{ asset('templates/node_modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
<script src="{{ asset('templates/node_modules/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('templates/js/scripts.js') }}"></script>
<script src="{{ asset('templates/js/custom.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('templates/js/page/auth-register.js') }}"></script>
<script src="{{ asset('templates/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>

<script>
    // === Custom Modal JS ===
    (function() {
        var modal     = document.getElementById('cmzModal');
        var backdrop  = document.getElementById('cmzBackdrop');
        var openLink  = document.getElementById('openTerms');
        var closeBtn  = document.getElementById('cmzCloseBtn');
        var closeBtn2 = document.getElementById('cmzCloseFooter');

        function openModal(e) {
            if (e) e.preventDefault();
            document.documentElement.classList.add('cmz-lock');
            document.body.classList.add('cmz-lock');
            modal.classList.add('cmz-open');
            backdrop.classList.add('cmz-open');
            modal.setAttribute('aria-hidden', 'false');
            backdrop.setAttribute('aria-hidden', 'false');
            // optional: fokus ke tombol close untuk aksesibilitas
            closeBtn && closeBtn.focus();
        }

        function closeModal() {
            modal.classList.remove('cmz-open');
            backdrop.classList.remove('cmz-open');
            modal.setAttribute('aria-hidden', 'true');
            backdrop.setAttribute('aria-hidden', 'true');
            document.documentElement.classList.remove('cmz-lock');
            document.body.classList.remove('cmz-lock');
        }

        // Klik link buka modal
        if (openLink) openLink.addEventListener('click', openModal);

        // Klik tombol close
        if (closeBtn)  closeBtn.addEventListener('click', closeModal);
        if (closeBtn2) closeBtn2.addEventListener('click', closeModal);

        // Klik di luar dialog untuk tutup
        modal.addEventListener('click', function(ev) {
            var dialog = ev.target.closest('.cmz-dialog');
            if (!dialog) closeModal();
        });

        // Esc untuk tutup
        document.addEventListener('keydown', function(ev) {
            if (ev.key === 'Escape') closeModal();
        });

        // Safety: jika ada hash #terms, bisa auto-open (opsional)
        if (window.location.hash === '#terms') openModal();
    })();

    // === (Opsional) file validation bawaan kamu ===
    function fileValidation() {
        var fileInput = document.getElementById('ktp');
        if (!fileInput) return true;

        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
            fileInput.value = '';
            return false;
        } else {
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var preview = document.getElementById('imagePreview');
                    if (preview) {
                        preview.innerHTML =
                            '<img id="image" src="' + e.target.result + '" style="width: 200px; height: 150px;"/>';
                    }
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    }

    function removeImage() {
        var image = document.getElementById('image');
        var preview = document.getElementById('imagePreview');
        if (image && preview) {
            preview.removeChild(image);
        }
    }
</script>
</body>
</html>
