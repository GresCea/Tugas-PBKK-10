<form method="POST" action="{{ $action }}">
    @csrf
    @if ($method !== 'POST') @method($method) @endif
    <div class="mb-3"><label class="form-label">Judul</label><input class="form-control" name="judul" value="{{ old('judul', $project?->judul) }}" required>@error('judul')<div class="text-danger">{{ $message }}</div>@enderror</div>
    <div class="mb-3"><label class="form-label">Tema Agent</label><input class="form-control" name="tema_agent" value="{{ old('tema_agent', $project?->tema_agent) }}" required>@error('tema_agent')<div class="text-danger">{{ $message }}</div>@enderror</div>
    <div class="mb-3"><label class="form-label">API Key Secure</label><input class="form-control" name="api_key_secure" value="{{ old('api_key_secure', $project?->api_key_secure) }}" required>@error('api_key_secure')<div class="text-danger">{{ $message }}</div>@enderror</div>
    <div class="mb-3"><label class="form-label">Deskripsi</label><textarea class="form-control" name="deskripsi" rows="4">{{ old('deskripsi', $project?->deskripsi) }}</textarea>@error('deskripsi')<div class="text-danger">{{ $message }}</div>@enderror</div>
    <button class="btn btn-primary">Simpan</button>
    <a class="btn btn-secondary" href="{{ route('projects.index') }}">Batal</a>
</form>
