<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pegawai</title>
</head>
<body>
    @if (session('sukses'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
            {{ session('sukses') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
            {{ session('error') }}
        </div>
    @endif

    <p><a href="{{ url('tambah-pegawai') }}">[+ Tambah Pegawai]</a> | <a href="{{ route('pegawai') }}">[Kembali ke Layout Dashboard]</a></p>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>No. Telepon</th>
                <th>Jabatan</th>
                <th>Email</th>
                <th>Role</th>
                <th colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pegawais as $pegawai)
                <tr>
                    <td>{{ $pegawai->id }}</td>
                    <td>{{ $pegawai->nama }}</td>
                    <td>{{ $pegawai->telp }}</td>
                    <td>{{ $pegawai->jabatan }}</td>
                    <td>{{ $pegawai->email }}</td>
                    <td>{{ $pegawai->role }}</td>
                    <td>
                        <form action="{{ route('pegawai.hapus', $pegawai) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pegawai {{ $pegawai->nama }}?')">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="[HAPUS]">
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('pegawai.ubah', $pegawai) }}">[UBAH]</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Belum ada data pegawai.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
