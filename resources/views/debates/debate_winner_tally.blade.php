<tr style="background-color: white; font-weight: bold;">
    <td><!--Blank for formatting--></td>
    <td><!--Blank for formatting--></td>
    <td>Apandah Wins: {{ $apandahWins }}</td>
    <td>Aztrosist Wins: {{ $aztroWins }}</td>
    <td>Jschlatt Wins: {{ $schlattWins }}</td>
    <td>Mikasacus Wins: {{ $mikaWins }}</td>
    @if ($GuestDebates::where('guest', true)->count() > 0)
        <td>Guest Wins: {{ 'Wins: ' . $GuestDebates::where('guest', true)->count() }}</td>
    @endif
    <td><!--Blank for formatting--></td>
    <td><!--Blank for formatting--></td>
    @if (Auth::check())
        <td><!--Blank for formatting--></td>
        <td><!--Blank for formatting--></td>
    @endif
</tr>
