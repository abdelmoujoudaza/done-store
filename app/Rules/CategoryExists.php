<?php

namespace App\Rules;

use Closure;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Contracts\Validation\ValidationRule;

class CategoryExists implements ValidationRule
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->categoryRepository->exists($value)) {
            $fail('One or more selected :attribute do not exist.');
        }
    }
}
