<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit Jadwal Periksa') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Silakan perbarui informasi jadwal periksa, termasuk tanggal, jam, dan status.') }}
                            </p>
                        </header>

                        <form class="mt-6" action="{{ route('dokter.jadwal_periksa.update', $jadwal_periksa->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label for="tanggal_periksa" class="block font-medium text-sm text-gray-700">Tanggal Periksa</label>
                                <input type="date" name="tanggal_periksa" id="tanggal_periksa" class="form-control rounded"
                                    value="{{ $jadwal_periksa->tanggal_periksa }}">
                            </div>

                            <div class="mb-3">
                                <label for="jam_mulai" class="block font-medium text-sm text-gray-700">Jam Mulai</label>
                                <input type="time" name="jam_mulai" id="jam_mulai" class="form-control rounded"
                                    value="{{ $jadwal_periksa->jam_mulai }}">
                            </div>

                            <div class="mb-3">
                                <label for="jam_selesai" class="block font-medium text-sm text-gray-700">Jam Selesai</label>
                                <input type="time" name="jam_selesai" id="jam_selesai" class="form-control rounded"
                                    value="{{ $jadwal_periksa->jam_selesai }}">
                            </div>

                            <div class="mb-3">
                                <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                                <select name="status" id="status" class="form-control rounded">
                                    <option value="1" {{ $jadwal_periksa->status == 1 ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ $jadwal_periksa->status == 0 ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>

                            <div class="flex items-center gap-3">
                                <a href="{{ route('dokter.jadwal.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
