<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat Terhapus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 bg-white shadow sm:rounded-lg sm:p-8">
                <header class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-medium text-red-600">
                        {{ __('Daftar Obat yang Terhapus') }}
                    </h2>
                    <a href="{{ route('dokter.obat.index') }}" class="btn btn-secondary">
                        Kembali ke Daftar Obat
                    </a>
                </header>

                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($trashedObats->count())
                    <table class="table table-hover rounded overflow-hidden">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Kemasan</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trashedObats as $obat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $obat->nama_obat }}</td>
                                    <td>{{ $obat->kemasan }}</td>
                                    <td>{{ 'Rp' . number_format($obat->harga, 0, ',', '.') }}</td>
                                    <td class="flex items-center gap-3">
                                        <form action="{{ route('dokter.obat.restore', $obat->id) }}" method="GET">
                                            <button type="submit" class="btn btn-success btn-sm">Pulihkan</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-600 mt-4">Tidak ada data obat yang terhapus.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
