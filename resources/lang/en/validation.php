<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | following language lines contain default error messages used by
    | validator class. Some of these rules have multiple versions such
    | as size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute doit être accepté.',
    'active_url'           => ':attribute n\'est pas une url valide.',
    'after'                => ':attribute doit être une date postérieur à :date.',
    'alpha'                => ':attribute ne peut contenir que des lettres.',
    'alpha_dash'           => ':attribute ne peut contenir que des lettres, des chiffres et des tirets.',
    'alpha_num'            => ':attribute ne peut contenir que des lettres et des chiffres.',
    'array'                => ':attribute doit être un tableau.',
    'before'               => ':attribute doit être une date antérieur à :date.',
    'between'              => [
        'numeric' => ':attribute doit être entre :min et :max.',
        'file'    => ':attribute doit être entre :min et :max Ko.',
        'string'  => ':attribute doit être entre :min et :max caractères.',
        'array'   => ':attribute doit être entre :min et :max objets.',
    ],
    'boolean'              => 'Le champ :attribute doit être vrai ou faux.',
    'confirmed'            => 'Le confirmation de :attribute ne fonctionne pas.',
    'date'                 => ':attribute n\'est pas une date valide.',
    'date_format'          => ':attribute n\'est pas un :format.',
    'different'            => ':attribute et :other doivent être différents.',
    'digits'               => ':attribute doit être :digits numérique.',
    'digits_between'       => ':attribute doit être entre :min et :max numérique.',
    'dimensions'           => ':attribute a une dimension d\'image invalide.',
    'distinct'             => 'Le champ :attribute a une valeur dupliqué.',
    'email'                => ':attribute doit être une adresse mail valide.',
    'exists'               => ':attribute est invalide.',
    'file'                 => ':attribute doit être un fichier.',
    'filled'               => ':attribute est obligatoire.',
    'image'                => ':attribute doit être une image.',
    'in'                   => ':attribute est invalide.',
    'in_array'             => ':attribute le champ n\'existe pas dans :other.',
    'integer'              => ':attribute doit être un nombre.',
    'ip'                   => ':attribute doit être une adresse IP valide.',
    'json'                 => ':attribute doit être un JSON valide.',
    'max'                  => [
        'numeric' => ':attribute ne peut être supérieur à :max.',
        'file'    => ':attribute ne peut être supérieur à :max Ko.',
        'string'  => ':attribute ne peut être supérieur à :max caractères.',
        'array'   => ':attribute ne peut être supérieur à :max objets.',
    ],
    'mimes'                => ':attribute doit être un fichier de type: :values.',
    'mimetypes'            => ':attribute doit être un fichier de type: :values.',
    'min'                  => [
        'numeric' => ':attribute doit être au moins :min.',
        'file'    => ':attribute doit être au moins :min Ko.',
        'string'  => ':attribute doit être au moins :min caractères.',
        'array'   => ':attribute doit être au moins :min objets.',
    ],
    'not_in'               => ':attribute est invalide.',
    'numeric'              => ':attribute doit être un nombre.',
    'present'              => 'Le champ :attribute doit être présent.',
    'regex'                => ':attribute format est invalide.',
    'required'             => 'Le champ :attribute est obligatoire.',
    'required_if'          => 'Le champ :attribute est obligatoire quand :other est :value.',
    'required_unless'      => 'Le champ :attribute est obligatoire sauf si :other est in :values.',
    'required_with'        => 'Le champ :attribute est obligatoire quand :values est présent.',
    'required_with_all'    => 'Le champ :attribute est obligatoire quand :values est présent.',
    'required_without'     => 'Le champ :attribute est obligatoire quand :values n\'est pas présent.',
    'required_without_all' => 'Le champ :attribute est obligatoire quand aucun de :values n\'est présent.',
    'same'                 => 'Le champ :attribute et :other doivent correspondre.',
    'size'                 => [
        'numeric' => ':attribute doit être :size.',
        'file'    => ':attribute doit être :size Ko.',
        'string'  => ':attribute doit être :size caractères.',
        'array'   => ':attribute doit contenir :size objets.',
    ],
    'string'               => ':attribute doit être un texte.',
    'timezone'             => ':attribute doit être un fuseau horaire valide.',
    'unique'               => ':attribute est déjà prit.',
    'uploaded'             => ':attribute a rencontré une erreur pendant l\'envoi.',
    'url'                  => 'Le format de :attribute est invalide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
