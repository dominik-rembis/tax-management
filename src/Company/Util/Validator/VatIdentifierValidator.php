<?php

declare(strict_types=1);

namespace App\Company\Util\Validator;

use App\Company\Model\Company;
use App\Core\Exception\ValidatorNotSupportModel;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Contracts\Translation\TranslatorInterface;

final class VatIdentifierValidator extends ConstraintValidator
{
    public function __construct(
        private array $vatValidationRules,
        private readonly TranslatorInterface $translator
    ) {
        $this->vatValidationRules = array_merge(...$vatValidationRules);
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        $model = $this->context->getObject();

        if (!$model instanceof Company) {
            throw new ValidatorNotSupportModel(Company::class);
        }

        if ($this->isNotCorrect($model->getAddress()->getCountry(), $value)) {
            $this->context
                ->buildViolation($constraint->getMessage())
                ->setParameter('{{ nip }}', $value)
                ->addViolation();
        }
    }

    private function isNotCorrect(string $country, string $vatIdentifier): bool
    {
        $expressionKey = $this->translator->trans(sprintf('vat_identifier.%s', strtolower($country)));
        $expression = sprintf('/%s/', $this->vatValidationRules[$expressionKey]);

        return !preg_match($expression, $vatIdentifier);
    }
}
