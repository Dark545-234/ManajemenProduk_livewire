<div>
    <div class="card shadow-sm mx-auto" style="max-width: 400px; margin-top: 50px;">
        <div class="card-header text-center bg-primary text-white">
            <h3 class="mb-0">Login</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="authenticate">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.live="email" required autofocus>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model.live="password" required>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" wire:model.live="remember">
                    <label class="form-check-label" for="remember">Ingat Saya</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <div class="text-center mt-3">
                Belum punya akun? <a href="{{'regis'}}" wire:navigate>Daftar di sini</a>
            </div>
        </div>
    </div>
</div>