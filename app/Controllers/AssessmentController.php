<?php

namespace App\Controllers;

use App\Models\IndicatorModel;
use App\Models\AssessmentModel;
use App\Models\AnswerModel;
use App\Models\CampusModel;
use App\Models\UserModel;

class AssessmentController extends BaseController
{
    public function index()
    {
        $session = session(); 
        $db = \Config\Database::connect();

        $indicators = $db->table('indicators')->get()->getResultArray();

        $campus = $db->table('campuses')->where('user_id', $session->get('id'))->get()->getRow();

        $data = [
            'indicators' => $indicators,
            'campus'     => $campus, 
            'title'      => 'Form Assessment DFR'
        ];

        return view('user/assessment', $data);
    }

    public function submit()
    {
        $session = session();
        $db = \Config\Database::connect();

        $answers = $this->request->getPost('answers'); 

        if (!$answers || count($answers) < 40) {
            return redirect()->back()->with('error', 'Gagal memproses! Harap isi seluruh 40 pertanyaan indikator sebelum menghitung hasil.');
        }

        $scores = ['E1' => [], 'E2' => [], 'E3' => [], 'E4' => []];
        foreach ($answers as $id => $skor) {
            $ind = $db->table('indicators')->where('id', $id)->get()->getRow();
            $scores[$ind->element][] = $skor;
        }

        $s_e1 = array_sum($scores['E1']) / count($scores['E1']);
        $s_e2 = array_sum($scores['E2']) / count($scores['E2']);
        $s_e3 = array_sum($scores['E3']) / count($scores['E3']);
        $s_e4 = array_sum($scores['E4']) / count($scores['E4']);

        $ws_e1 = $s_e1 * 0.3917;
        $ws_e2 = $s_e2 * 0.2999;
        $ws_e3 = $s_e3 * 0.1683;
        $ws_e4 = $s_e4 * 0.1401;

        $total_ri = $ws_e1 + $ws_e2 + $ws_e3 + $ws_e4;
        $ri_100 = (($total_ri - 1) / 4) * 100;

        if ($total_ri <= 1.80) $level = 'Initial';
        elseif ($total_ri <= 2.60) $level = 'Repeatable';
        elseif ($total_ri <= 3.40) $level = 'Defined';
        elseif ($total_ri <= 4.20) $level = 'Managed';
        else $level = 'Optimized';

        $campus = $db->table('campuses')->where('user_id', $session->get('id'))->get()->getRow();

        $assessmentData = [
            'campus_id'  => $campus->id,
            'score_e1'   => $s_e1,
            'score_e2'   => $s_e2,
            'score_e3'   => $s_e3,
            'score_e4'   => $s_e4,
            'ws_e1'      => $ws_e1,
            'ws_e2'      => $ws_e2,
            'ws_e3'      => $ws_e3,
            'ws_e4'      => $ws_e4,
            'total_ri'   => $total_ri,
            'ri_100'     => $ri_100,
            'maturity_level' => $level
        ];

        $db->table('assessments')->insert($assessmentData);
        $assessmentId = $db->insertID();

        foreach ($answers as $id => $skor) {
            $db->table('assessment_answers')->insert([
                'assessment_id' => $assessmentId,
                'indicator_id'  => $id,
                'skor'          => $skor
            ]);
        }

        return redirect()->to('/user/dashboard');
    }

    public function dashboard()
    {
        $session = session();
        $db = \Config\Database::connect();

        $campus = $db->table('campuses')->where('user_id', $session->get('id'))->get()->getRow();

        $result = $db->table('assessments')->where('campus_id', $campus->id)->orderBy('id', 'DESC')->get()->getRow();

        if (!$result) {
            return redirect()->to('/user/assessment')->with('error', 'Silakan isi assessment terlebih dahulu.');
        }

        $data = [
            'title'  => 'Dashboard Hasil DFR',
            'campus' => $campus,
            'result' => $result,
            'conclusion' => $this->get_conclusion($result->maturity_level)
        ];

        return view('user/dashboard', $data);
    }

    public function profile()
    {
        $session = session();
        $db = \Config\Database::connect();

        $campus = $db->table('campuses')->where('user_id', $session->get('id'))->get()->getRow();

        $data = [
            'title'  => 'Pengaturan Profil - DFR',
            'campus' => $campus
        ];

        return view('user/profile', $data);
    }

    public function update_profile()
    {
        $session = session();
        $db = \Config\Database::connect();
        $id_user = $session->get('id');

        $username = $this->request->getPost('username');
        $new_password = $this->request->getPost('new_password');
        $confirm_password = $this->request->getPost('confirm_password');

        $dataUpdate = ['username' => $username];

        if (!empty($new_password)) {
            if ($new_password !== $confirm_password) {
                return redirect()->back()->with('error', 'Gagal: Password baru dan konfirmasi tidak cocok!');
            }
            $dataUpdate['password'] = password_hash($new_password, PASSWORD_BCRYPT);
        }

        $cekUser = $db->table('users')->where('username', $username)->where('id !=', $id_user)->get()->getRow();
        if ($cekUser) {
            return redirect()->back()->with('error', 'Gagal: Username tersebut sudah digunakan oleh pengguna lain.');
        }

        $db->table('users')->where('id', $id_user)->update($dataUpdate);

        $session->set('username', $username);

        return redirect()->to('/user/profile')->with('success', 'Berhasil: Profil dan keamanan akun telah diperbarui!');
    }

    public function admin_dashboard()
    {
        $db = \Config\Database::connect();

        $data['title'] = "Dashboard Admin";
        $data['total_kampus'] = $db->table('campuses')->countAllResults();
        $data['total_assessment'] = $db->table('assessments')->countAllResults();
        $data['avg_readiness'] = $db->table('assessments')->selectAvg('ri_100')->get()->getRow()->ri_100;

        $data['top_kampus'] = $db->table('assessments')
            ->select('campuses.nama_kampus, assessments.ri_100')
            ->join('campuses', 'campuses.id = assessments.campus_id')
            ->orderBy('ri_100', 'DESC')
            ->limit(1)
            ->get()->getRow();

        $data['comparison'] = $db->table('assessments')
            ->select('campuses.nama_kampus, assessments.ri_100')
            ->join('campuses', 'campuses.id = assessments.campus_id')
            ->orderBy('ri_100', 'DESC')
            ->get()->getResultArray();

        return view('admin/dashboard', $data);
    }

    public function admin_rekap()
    {
        $db = \Config\Database::connect();

        $data['title'] = "Rekapitulasi Hasil";
        $data['results'] = $db->table('assessments')
            ->select('assessments.*, campuses.nama_kampus')
            ->join('campuses', 'campuses.id = assessments.campus_id')
            ->orderBy('created_at', 'DESC')
            ->get()->getResultArray();

        return view('admin/rekap', $data);
    }

    public function admin_detail($id)
    {
        $db = \Config\Database::connect();

        $result = $db->table('assessments')->where('id', $id)->get()->getRow();

        if (!$result) {
            return redirect()->to('/admin/rekap')->with('error', 'Data tidak ditemukan.');
        }

        $campus = $db->table('campuses')->where('id', $result->campus_id)->get()->getRow();

        $data = [
            'title'  => 'Detail Laporan: ' . $campus->nama_kampus,
            'campus' => $campus,
            'result' => $result,
            'conclusion' => $this->get_conclusion($result->maturity_level)
        ];

        return view('admin/detail', $data);
    }

    private function get_conclusion($level)
    {
        $recommendations = [
            'Initial'    => 'Universitas Anda berada pada tahap awal. Segera susun kebijakan dasar terkait forensik digital dan mulailah mendokumentasikan setiap insiden TI secara manual.',
            'Repeatable' => 'Proses sudah mulai dilakukan berulang namun belum terstandarisasi. Fokuskan pada pembuatan SOP (Standar Operasional Prosedur) yang baku untuk seluruh unit TI.',
            'Defined'    => 'Sistem sudah terdefinisi dengan baik. Langkah selanjutnya adalah memastikan seluruh SDM mendapatkan pelatihan rutin dan mengintegrasikan alat deteksi otomatis.',
            'Managed'    => 'Sistem sudah dikelola dan dipantau dengan metrik yang jelas. Terus lakukan evaluasi berkala dan audit internal untuk mempertahankan kualitas kesiapan.',
            'Optimized'  => 'Luar biasa! Sistem Anda sudah berada pada tahap optimasi. Fokuskan pada inovasi teknologi terbaru seperti AI untuk deteksi dini ancaman siber.'
        ];

        return $recommendations[$level] ?? 'Silakan hubungi administrator untuk analisis lebih lanjut.';
    }

    public function export_pdf($id)
    {
        $db = \Config\Database::connect();
        $result = $db->table('assessments')->where('id', $id)->get()->getRow();
        $campus = $db->table('campuses')->where('id', $result->campus_id)->get()->getRow();

        $data = [
            'result' => $result,
            'campus' => $campus,
            'conclusion' => $this->get_conclusion($result->maturity_level)
        ];

        $dompdf = new \Dompdf\Dompdf();
        $html = view('user/export_pdf', $data);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $nama_file = "Laporan_DFR_" . str_replace(' ', '_', $campus->nama_kampus) . ".pdf";

        $dompdf->stream($nama_file, ["Attachment" => true]);
        exit();
    }

    public function admin_profile()
    {
        $data = [
            'title' => 'Pengaturan Profil Admin'
        ];

        return view('admin/profile', $data);
    }

    public function admin_update_profile()
    {
        $session = session();
        $db = \Config\Database::connect();
        $id_user = $session->get('id');

        $username = $this->request->getPost('username');
        $new_password = $this->request->getPost('new_password');
        $confirm_password = $this->request->getPost('confirm_password');

        $dataUpdate = ['username' => $username];

        if (!empty($new_password)) {
            if ($new_password !== $confirm_password) {
                return redirect()->back()->with('error', 'Gagal: Password baru dan konfirmasi tidak cocok!');
            }
            $dataUpdate['password'] = password_hash($new_password, PASSWORD_BCRYPT);
        }

        $cekUser = $db->table('users')->where('username', $username)->where('id !=', $id_user)->get()->getRow();
        if ($cekUser) {
            return redirect()->back()->with('error', 'Gagal: Username tersebut sudah digunakan.');
        }

        $db->table('users')->where('id', $id_user)->update($dataUpdate);

        $session->set('username', $username);

        return redirect()->to('/admin/profile')->with('success', 'Berhasil: Profil keamanan Admin telah diperbarui!');
    }

    public function history()
    {
        $session = session();
        $db = \Config\Database::connect();

        $campus = $db->table('campuses')->where('user_id', $session->get('id'))->get()->getRow();

        $latestAssessment = $db->table('assessments')
            ->where('campus_id', $campus->id)
            ->orderBy('created_at', 'DESC')
            ->get()->getRow();

        if (!$latestAssessment) {
            return redirect()->to('/user/dashboard')->with('error', 'Belum ada riwayat assessment yang bisa dilihat.');
        }

        $answers = $db->table('assessment_answers')
            ->select('assessment_answers.skor, indicators.code, indicators.statement, indicators.element')
            ->join('indicators', 'indicators.id = assessment_answers.indicator_id')
            ->where('assessment_answers.assessment_id', $latestAssessment->id)
            ->orderBy('indicators.id', 'ASC')
            ->get()->getResultArray();

        $data = [
            'title'      => 'Riwayat Jawaban - DFR System',
            'campus'     => $campus,
            'assessment' => $latestAssessment,
            'answers'    => $answers
        ];

        return view('user/history', $data);
    }
}