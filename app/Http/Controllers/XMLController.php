<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;

class XMLController extends Controller
{
    private $xmlStoragePath = 'xml_files/';

    public function store(Request $request)
    {
        // Validação do XML
        $request->validate([
            'file' => 'required|file|mimes:xml|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Obtém o conteúdo do XML
            $xmlContent = file_get_contents($file->getRealPath());

            // Salva o arquivo no storage
            $fileName = time() . '_' . $file->getClientOriginalName();
            Storage::disk('local')->put($this->xmlStoragePath . $fileName, $xmlContent);

            // Redireciona para a página de exibição
            return redirect()->route('data.xml', ['file' => $fileName]);
        }

        return back()->with('error', 'Erro ao enviar arquivo.');
    }

    public function show(Request $request)
    {
        $fileName = $request->query('file');

        if (!$fileName || !Storage::disk('local')->exists($this->xmlStoragePath . $fileName)) {
            return "Arquivo não encontrado.";
        }

        // Lendo o XML armazenado
        $xmlContent = Storage::disk('local')->get($this->xmlStoragePath . $fileName);
        $xml = new SimpleXMLElement($xmlContent);

        // Atualizando o caminho da view
        return view('nf.data', compact('xml'));
    }
}
