<p>Vous avez été invité à rejoindre la société {{ $invitation->societe->nom }}</p>
<p>Cliquez sur le lien ci-dessous pour accepter l'invitation :</p>
<a href="{{ url('accepter/' . $invitation->token) }}">Accepter l'invitation</a>
<p>Si vous n'avez pas demandé cette invitation, vous pouvez l'ignorer.</p>
