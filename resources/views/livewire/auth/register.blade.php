<div>
    <div class="card shadow-sm mx-auto" style="max-width: 400px; margin-top: 50px;">
        <div class="card-header text-center bg-primary text-white">
            <h3 class="mb-0">Daftar Akun Baru</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="register">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.live="name" required autofocus>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.live="email" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model.live="password" required>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" wire:model.live="password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Daftar</button>
            </form>
            <div class="text-center mt-3">
                Sudah punya akun? <a href="{{'login'}}" wire:navigate>Login di sini</a>
            </div>
        </div>
    </div>
</div>