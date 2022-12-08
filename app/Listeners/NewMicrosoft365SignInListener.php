<?php

namespace App\Listeners;

use App\Models\User;
use Dcblogdev\MsGraph\Models\MsGraphToken;
use Illuminate\Support\Facades\Auth;

class NewMicrosoft365SignInListener
{
    public function handle($event)
    {
        $tokenId = $event->token['token_id'];
        $token   = MsGraphToken::find($tokenId)->first();

        if ($token->user_id == null) {
            $user = User::create([
                'nombre'     => $event->token['info']['displayName'],
                'email_udemex'    => $event->token['info']['mail'],
            ]);

            $token->user_id = $user->id;
            $token->save();

            Auth::login($user);
        } else {
            $user = User::findOrFail($token->user_id);
            $user->save();

            Auth::login($user);
        }
    }
}
