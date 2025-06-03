<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Tambah Jadwal Periksa') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Silakan isi form di bawah ini untuk menambahkan data Jadwal Periksa Dokter ke dalam sistem.') }}
                            </p>

                        </header>

                        <form class="mt-6" id="formJadwalPeriksa" action="{{ route('dokter.jadwal_periksa.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="hari" class="block font-medium text-sm text-gray-700">Hari</label>
                                <select name="hari" id="hari" class="form-select rounded w-full" required>
                                    <option value="">-- Pilih Hari --</option>
                                    @foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hari)
                                        <option value="{{ $hari }}">{{ $hari }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="jammulai">Jam Awal</label>
                                <input type="time" class="rounded form-control" id="jammulai" name="jam_mulai">
                            </div>
                            <div class="mb-3 form-group">
                                <label for="jamselesia">Jam Akhir</label>
                                <input type="time" class="rounded form-control" id="jamselesai" name="jam_selesai">
                            </div>

                            <a type="button" href="{{ route('dokter.jadwal_periksa.index') }}" class="btn btn-secondary">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
