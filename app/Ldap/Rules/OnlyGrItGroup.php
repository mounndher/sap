<?php

namespace App\Ldap\Rules;

use Illuminate\Database\Eloquent\Model as Eloquent;
use LdapRecord\Laravel\Auth\Rule;
use LdapRecord\Models\Model as LdapRecord;
 use Illuminate\Support\Facades\Log;
class OnlyGrItGroup implements Rule
{
    /**
     * Check if the rule passes validation.
     */


public function passes(\LdapRecord\Models\Model $user, \Illuminate\Database\Eloquent\Model $model = null): bool
{
    // This is the full DN of the allowed group
    $targetGroupDn = 'CN=gr-IT,OU=Départements,OU=Groups,OU=PharmaInvest Production,DC=local,DC=pharma';

    // Fetch all DNs of the user's groups
    $userGroupDns = $user->groups()->recursive()->get()
        ->filter(fn ($g) => $g instanceof \LdapRecord\Models\Model)
        ->map(fn ($group) => $group->getDn())
        ->toArray();

    return in_array($targetGroupDn, $userGroupDns);
}


}
