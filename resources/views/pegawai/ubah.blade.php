<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Pegawai</title>
</head>
<body>
    <h2>Ubah Pegawai</h2>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ url('update-pegawai') }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $pegawai->id }}">
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="{{ old('nama', $pegawai->nama) }}" required></td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td><input type="text" name="telp" value="{{ old('telp', $pegawai->telp) }}" required></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td><input type="text" name="jabatan" value="{{ old('jabatan', $pegawai->jabatan) }}" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" value="{{ old('email', $pegawai->email) }}" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="password" placeholder="Kosongkan jika tidak diubah">
                </td>
            </tr>
            <tr>
                <td>Role</td>
                <td>
                    <select name="role" required>
                        <option value="admin" {{ old('role', $pegawai->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role', $pegawai->role) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <input type="submit" value="Simpan Perubahan">
                    <a href="{{ url('daftar-pegawai') }}">Batal</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
