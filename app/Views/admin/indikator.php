<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>
<div class="max-w-7xl mx-auto space-y-8" x-data="indicatorManager()">

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-slate-200 pb-6">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Master Indikator & Bobot</h2>
            <p class="text-slate-500 font-medium text-sm mt-1">Kelola pertanyaan kuesioner dan nilai bobot AHP sistem.</p>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3">
            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span class="font-medium text-sm"><?= session()->getFlashdata('success') ?></span>
        </div>
    <?php endif; ?>

    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm relative overflow-hidden">
        <div class="flex items-center gap-2 mb-6 border-b border-slate-100 pb-4">
            <div class="w-2 h-6 bg-orange-500 rounded-full"></div>
            <h3 class="text-lg font-bold text-slate-800">Pengaturan Bobot Elemen (AHP)</h3>
        </div>

        <form action="/admin/indikator/update_bobot" method="POST" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <?php foreach ($elements as $el): ?>
                <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2"><?= $el['code'] ?> - <?= $el['name'] ?></label>
                    <input type="number" step="0.0001" name="weight[<?= $el['code'] ?>]" value="<?= $el['weight'] ?>" required
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition font-bold text-slate-700">
                </div>
            <?php endforeach; ?>
            <div class="sm:col-span-2 md:col-span-4 flex justify-end mt-2">
                <button type="submit" class="px-6 py-2.5 bg-orange-500 text-white font-bold rounded-xl shadow-md shadow-orange-200 hover:bg-orange-600 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Simpan Bobot Baru
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm relative overflow-hidden">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-4 mb-6">
            <div class="flex items-center gap-2">
                <div class="w-2 h-6 bg-blue-600 rounded-full"></div>
                <h3 class="text-lg font-bold text-slate-800">Daftar Indikator Kuesioner</h3>
            </div>
            <button @click="openModal('add')" class="px-4 py-2 bg-blue-600 text-white font-bold rounded-xl shadow-md shadow-blue-200 hover:bg-blue-700 transition flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Indikator
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                        <th class="p-4 font-bold border-y border-slate-200 text-center w-12">No.</th>
                        <th class="p-4 font-bold border-y border-slate-200">Kode</th>
                        <th class="p-4 font-bold border-y border-slate-200">Elemen</th>
                        <th class="p-4 font-bold border-y border-slate-200">Pernyataan Assessment</th>
                        <th class="p-4 font-bold border-y border-slate-200 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $no = 1;
                    foreach ($indicators as $ind): ?>
                        <tr class="hover:bg-blue-50/50 transition">
                            <td class="p-4 text-slate-500 font-semibold text-center"><?= $no++ ?></td>

                            <td class="p-4 font-bold text-slate-700 whitespace-nowrap"><?= $ind['code'] ?></td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-600 text-[10px] font-extrabold rounded-md uppercase"><?= $ind['element'] ?></span>
                            </td>
                            <td class="p-4 text-sm text-slate-600 leading-relaxed max-w-xl"><?= $ind['statement'] ?></td>
                            <td class="p-4 flex items-center justify-end gap-2">
                                <button @click="openModal('edit', <?= htmlspecialchars(json_encode($ind)) ?>)" class="p-2 text-blue-500 hover:bg-blue-100 rounded-lg transition" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <a href="/admin/indikator/delete/<?= $ind['id'] ?>" onclick="return confirm('Yakin ingin menghapus indikator ini? Data jawaban kampus untuk indikator ini juga akan terhapus.')" class="p-2 text-red-500 hover:bg-red-100 rounded-lg transition" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center px-4">
        <div x-show="modalOpen" @click="closeModal()" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>
        <div x-show="modalOpen" class="relative bg-white rounded-3xl shadow-2xl max-w-lg w-full p-6 sm:p-8 transform transition-all">

            <div class="flex items-center justify-between mb-6 border-b border-slate-100 pb-4">
                <h3 class="text-xl font-extrabold text-slate-900" x-text="modalType === 'add' ? 'Tambah Indikator' : 'Edit Indikator'"></h3>
                <button @click="closeModal()" class="text-slate-400 hover:text-red-500 transition"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg></button>
            </div>

            <form :action="formAction" method="POST" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Elemen</label>
                        <select name="element" x-model="formData.element" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none font-medium text-slate-700 bg-white">
                            <?php foreach ($elements as $el): ?>
                                <option value="<?= $el['code'] ?>"><?= $el['code'] ?> - <?= $el['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Kode (Contoh: S1)</label>
                        <input type="text" name="code" x-model="formData.code" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none font-bold text-slate-700">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Pernyataan</label>
                    <textarea name="statement" x-model="formData.statement" rows="4" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none font-medium text-slate-700 resize-none"></textarea>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" @click="closeModal()" class="flex-1 py-2.5 bg-slate-100 text-slate-600 font-bold rounded-xl hover:bg-slate-200 transition">Batal</button>
                    <button type="submit" class="flex-1 py-2.5 bg-blue-600 text-white font-bold rounded-xl shadow-md shadow-blue-200 hover:bg-blue-700 transition" x-text="modalType === 'add' ? 'Simpan' : 'Update'"></button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('indicatorManager', () => ({
            modalOpen: false,
            modalType: 'add',
            formAction: '/admin/indikator/store',
            formData: {
                id: '',
                element: 'E1',
                code: '',
                statement: ''
            },

            openModal(type, data = null) {
                this.modalType = type;
                if (type === 'edit' && data) {
                    this.formData = {
                        ...data
                    };
                    this.formAction = '/admin/indikator/update/' + data.id;
                } else {
                    this.formData = {
                        id: '',
                        element: 'E1',
                        code: '',
                        statement: ''
                    };
                    this.formAction = '/admin/indikator/store';
                }
                this.modalOpen = true;
            },

            closeModal() {
                this.modalOpen = false;
            }
        }));
    });
</script>
<?= $this->endSection() ?>