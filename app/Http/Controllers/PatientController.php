<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Tampilkan daftar pasien dengan pagination
    public function index()
    {
        $patients = Patient::paginate(10);
        return view('patients.index', compact('patients'));
    }

    // Tampilkan form untuk membuat pasien baru
    public function create()
    {
        return view('patients.create');
    }

    // Simpan data pasien baru ke database
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:patients,email',
            'phone' => 'required',
            'dob' => 'required|date',
        ]);

        // Buat pasien baru
        Patient::create($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil dibuat.');
    }

    // Tampilkan detail pasien
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    // Tampilkan form untuk edit pasien
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    // Update data pasien
    public function update(Request $request, Patient $patient)
    {
        // Validasi data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:patients,email,' . $patient->id,
            'phone' => 'required',
            'dob' => 'required|date',
        ]);

        // Update pasien
        $patient->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil diupdate');
    }

    // Hapus pasien
    public function destroy(Patient $patient)
    {
        $patient->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil dihapus.');
    }
}
