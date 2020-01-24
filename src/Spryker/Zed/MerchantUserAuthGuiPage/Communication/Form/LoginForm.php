<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantUserAuthGuiPage\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Required;

/**
 * @method \Spryker\Zed\MerchantUserAuthGuiPage\MerchantUserAuthGuiPageConfig getConfig()
 * @method \Spryker\Zed\MerchantUserAuthGuiPage\Communication\MerchantUserAuthGuiPageCommunicationFactory getFactory()
 */
class LoginForm extends AbstractType
{
    public const FIELD_USERNAME = 'username';
    public const FIELD_PASSWORD = 'password';

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addUserNameField($builder)->addPasswordField($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addUserNameField(FormBuilderInterface $builder)
    {
        $builder->add(
            static::FIELD_USERNAME,
            EmailType::class,
            [
                    'constraints' => [
                        new Required(),
                        new NotBlank(),
                    ],
                    'attr' => [
                    'placeholder' => 'Email Address',
                    ],
            ]
        );

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addPasswordField(FormBuilderInterface $builder)
    {
        $builder->add(
            static::FIELD_PASSWORD,
            PasswordType::class,
            [
                    'constraints' => [
                        new Required(),
                        new NotBlank(),
                    ],
                    'attr' => [
                    'placeholder' => 'Password',
                    'autocomplete' => 'off',
                    ],
            ]
        );

        return $this;
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'merchant-user-auth-gui-page';
    }
}
