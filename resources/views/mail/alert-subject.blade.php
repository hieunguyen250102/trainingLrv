<table>
    <th>Môn</th>
    <tbody>
        @foreach ($subjects as $sub)
        <tr>
            <td>{{$sub->name}}</td>
        </tr>
        @endforeach
    </tbody>
</table>