<x-relatorio>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>modelo</th>
                <th>Cor</th>
                <th>tamanho</th>
                <th>quantidade</th>
                <th>categoria</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($camisetas as $camiseta)
                <tr>
                    <td>{{ $camiseta->codigo }}</td>
                    <td>{{ $camiseta->modelo }}</td>
                    <td>{{ $camiseta->cor }}</td>
                    <td>{{ $camiseta->tamanho }}</td>
                    <td>{{ $camiseta->quantidade }}</td>
                    <td>{{ $camiseta->categoria }}</td>
                    <td>{{ \Carbon\Carbon::parse($recent->created_at)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-relatorio>
