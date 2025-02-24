<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        // Validação do arquivo
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf,xml|max:2048', // Máx: 2MB
        ]);

        // Recuperando o arquivo
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Salvando no storage/app/public/uploads
            $path = $file->store('uploads', 'public');

            return "Arquivo enviado com sucesso! Caminho: /storage/$path";
        }

        return "Nenhum arquivo foi enviado.";
    }
}
