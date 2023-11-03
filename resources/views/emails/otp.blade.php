<div>
    <h2>Bonjour {{ $user->nom }},</h2>
    <p> Votre compte est 
    <strong>{{ $user->otp }}</strong>.
     Veuillez vous rendre sur (cliquez) 
     <a href="{{url('/login')}}">
    <strong> admission croua2 </strong></a>
     pour vous connecter.</p>
</div>