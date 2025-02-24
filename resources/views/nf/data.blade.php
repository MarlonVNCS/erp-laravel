<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibição de NFe</title>
</head>
<body>
    <h1>Detalhes da Nota Fiscal Eletrônica</h1>

    {{-- @php
        var_dump($xml);
    @endphp --}}
    @if ($xml)
    <!-- Verificando se a chave existe antes de exibir -->
        @php
            $ns = $xml->getNamespaces(true);
            $nfe = $xml->children($ns['']);
            $infNFe = $nfe->NFe->infNFe;
            $emit = $infNFe->emit;
            $dest = $infNFe->dest;
            $det = $infNFe->det;
            $total = $infNFe->total;
            $icmsTot = $total->ICMSTot;

            // Função para remover "R$" e converter para float
            function formatCurrency($value) {
                $value = preg_replace('/[^\d,.-]/', '', $value); // Remove qualquer caractere que não seja número, vírgula, ponto ou hífen
                return number_format((float)str_replace(',', '.', $value), 2, ',', '.');
            }
        @endphp
        <div>
            <h2>Informações da NFe:</h2>
            <p><strong>Chave de Acesso:</strong> {{ isset($infNFe->attributes()->Id) ? $infNFe->attributes()->Id : 'N/A' }}</p>
            <p><strong>Emitente:</strong> {{ isset($emit->xNome) ? $emit->xNome : 'N/A' }}</p>
            <p><strong>Destinatário:</strong> {{ isset($dest->xNome) ? $dest->xNome : 'N/A' }}</p>
            <p><strong>Data de Emissão:</strong> {{ isset($infNFe->ide->dEmi) ? $infNFe->ide->dEmi : 'N/A' }}</p>
            <p><strong>Valor Total:</strong> R$ {{ isset($icmsTot->vNF) ? formatCurrency($icmsTot->vNF) : 'N/A' }}</p>
        </div>

        <div>
            <h3>Itens:</h3>
            <ul>
                @foreach ($det as $item)
                    <li>
                        <p><strong>Código:</strong> {{ isset($item->prod->cProd) ? $item->prod->cProd : 'N/A' }}</p>
                        <p><strong>Descrição:</strong> {{ isset($item->prod->xProd) ? $item->prod->xProd : 'N/A' }}</p>
                        <p><strong>Quantidade:</strong> {{ isset($item->prod->qCom) ? $item->prod->qCom : 'N/A' }} {{ isset($item->prod->uCom) ? $item->prod->uCom : 'N/A' }}</p>
                        <p><strong>Valor Unitário:</strong> R$ {{ isset($item->prod->vUnCom) ? formatCurrency($item->prod->vUnCom) : 'N/A' }}</p>
                        <p><strong>Total:</strong> R$ {{ isset($item->prod->vProd) ? formatCurrency($item->prod->vProd) : 'N/A' }}</p>
                    </li>
                @endforeach
            </ul>
        </div>

    @else
        <p>Arquivo XML não encontrado ou corrompido.</p>
    @endif
</body>
</html>
