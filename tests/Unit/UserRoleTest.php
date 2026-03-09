<?php

use App\Enums\UserRole;

test('UserRole enum contains strictly 5 roles', function () {
    $cases = UserRole::cases();

    expect($cases)->toHaveCount(5);

    $values = array_map(fn ($case) => $case->value, $cases);

    expect($values)->toContain('Developer');
    expect($values)->toContain('Clerk');
    expect($values)->toContain('Officer');
    expect($values)->toContain('Assistant Director');
    expect($values)->toContain('Director');
});
