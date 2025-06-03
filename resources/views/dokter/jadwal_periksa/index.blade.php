<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Jadwal Periksa') }}
                        </h2>

                        <div class="flex-col items-center justify-center text-center">
                            <a href="{{ route('dokter.jadwal_periksa.create') }}" class="btn btn-primary">Tambah Jadwal Periksa</a>

                            @if (session('status') === 'jadwal-created')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-green-600">{{ __('Jadwal berhasil ditambahkan.') }}</p>
                            @elseif (session('status') === 'jadwal-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-blue-600">{{ __('Jadwal berhasil diperbarui.') }}</p>
                            @elseif (session('status') === 'jadwal-deleted')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-red-600">{{ __('Jadwal berhasil dihapus.') }}</p>
                            @endif
                        </div>
                    </header>

                    <table class="table mt-6 overflow-hidden rounded table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Hari</th>
                                <th class="text-center">Jam Mulai</th>
                                <th class="text-center">Jam Selesai</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $namaHari = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
                            @endphp

                            @foreach ($JadwalPeriksas as $jadwal)
                                <tr>
                                    <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                    <td class="align-middle text-center">{{ $jadwal->hari ?? 'Tidak diketahui' }}</td>
                                    <td class="align-middle text-center">{{ $jadwal->jam_mulai }}</td>
                                    <td class="align-middle text-center">{{ $jadwal->jam_selesai }}</td>
                                    <td class="align-middle text-center">
                                        @if ($jadwal->status)
                                            <span class="badge badge-pill badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Nonaktif</span>
                                        @endif
                                    </td >
                                    <td class="align-center justify-center flex gap-2 ">
                                        <form class="p-1" action="{{ route('dokter.jadwal_periksa.toggleStatus', $jadwal->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            @if ($jadwal->status)
                                                <button type="submit" class="btn btn-danger btn-sm">Nonaktif</button>
                                            @else
                                                <button type="submit" class="btn btn-success btn-sm">Aktif</button>
                                            @endif
                                        </form>
                                         <form class="p-1" action="{{ route('dokter.jadwal_periksa.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
