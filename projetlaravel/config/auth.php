<?php

return [

    /*
    |-Paramètres d'authentification par défaut
     |--------------------------------------------------------------- -------------------------
     |
     | Cette option contrôle le "gard" et le mot de passe d'authentification par défaut
     | réinitialiser les options de votre application. Vous pouvez modifier ces valeurs par défaut
     | selon les besoins, mais ils sont un début parfait pour la plupart des applications.
     |
     */
    

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    || Ensuite, vous pouvez définir chaque garde d'authentification pour votre application.
     | Bien sûr, une super configuration par défaut a été définie pour vous
     | here qui utilise le stockage de session et le fournisseur d'utilisateurs Eloquent.
     |
     | Tous les pilotes d'authentification ont un fournisseur d'utilisateurs. Cela définit comment le
     | les utilisateurs sont en fait extraits de votre base de données ou d'un autre stockage
     | mécanismes utilisés par cette application pour conserver les données de votre utilisateur.
    |
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Tous les pilotes d'authentification ont un fournisseur d'utilisateurs. Cela définit comment le
     | les utilisateurs sont en fait extraits de votre base de données ou d'un autre stockage
     | mécanismes utilisés par cette application pour conserver les données de votre utilisateur.
     |
     | Si vous avez plusieurs tables ou modèles d'utilisateurs, vous pouvez configurer plusieurs
     | sources qui représentent chaque modèle / table. Ces sources peuvent alors
     | être affecté à tous les gardes d'authentification supplémentaires que vous avez définis.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
  | Vous pouvez spécifier plusieurs configurations de réinitialisation de mot de passe si vous avez plus
     | plus d'une table utilisateur ou d'un modèle dans l'application et vous souhaitez avoir
     | paramètres de réinitialisation de mot de passe distincts en fonction des types d'utilisateurs spécifiques.
     |
     | Le délai d'expiration correspond au nombre de minutes pendant lesquelles chaque jeton de réinitialisation
     | considéré comme valable. Cette fonctionnalité de sécurité maintient les jetons de courte durée afin
     | ils ont moins de temps pour être devinés. Vous pouvez modifier cela si nécessaire.
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
