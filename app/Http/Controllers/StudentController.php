<?php


namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class studentController extends Controller
{
    /**
     * Tampilkan daftar student.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $students = student::all();
        return response()->json($students);
    }

    /**
     * Simpan student baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'nisn' => 'required|numeric',
            'no_kk' => 'required|string',
            'nik' => 'required|string',

        ]);

        // Siapkan data untuk disimpan
        $data = $request->all();

        // Proses upload file pas_foto jika ada


        // Simpan data student
        $student = student::create($data);

        // Kembali dengan respon sukses
        return response()->json(['success' => 'student baru berhasil ditambahkan!', 'student' => $student], 201);
    }

    /**
     * Tampilkan detail student.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $student = student::find($id);

        if (!$student) {
            return response()->json(['error' => 'student tidak ditemukan'], 404);
        }

        return response()->json($student);
    }

    /**
     * Update data student di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nisn' => 'required|numeric',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'no_kk' => 'required|string',
            'nik' => 'required|string',

        ]);

        $student = student::find($id);

        if (!$student) {
            return response()->json(['error' => 'student tidak ditemukan'], 404);
        }

        // Siapkan data untuk diupdate
        $data = $request->all();

        // Proses upload file pas_foto jika ad

        // Update data student
        $student->update($data);

        // Kembali dengan respon sukses
        return response()->json(['success' => 'Data student berhasil diupdate!', 'student' => $student]);
    }

    /**
     * Hapus student dari database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $student = student::find($id);

        if (!$student) {
            return response()->json(['error' => 'student tidak ditemukan'], 404);
        }

        // Hapus file pas_foto jika ada
        if ($student->pas_foto) {
            Storage::disk('public')->delete($student->pas_foto);
        }

        // Hapus data student
        $student->delete();

        // Kembali dengan respon sukses
        return response()->json(['success' => 'student berhasil dihapus!']);
    }
}
