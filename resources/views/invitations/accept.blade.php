
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <form method="POST" action="{{ route('complete_profile') }}">
                @csrf
                <input type="password" name="password" placeholder="Votre mot de passe" required>
                <button type="submit">Valider</button>
            </form>
        </div>
    </div>
</div>

